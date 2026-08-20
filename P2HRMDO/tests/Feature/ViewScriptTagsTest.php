<?php

namespace Tests\Feature;

use Tests\TestCase;

/**
 * These pages once loaded three different jQuery builds in sequence: 3.6.0,
 * then 3.2.1 slim - which has no $.ajax - and then 1.4.2 over plain http.
 * The last one won, so the application's AJAX ran on a jQuery from 2010, and
 * on an HTTPS deployment that script is blocked as mixed content, leaving the
 * slim build in place and every $.ajax call undefined.
 */
class ViewScriptTagsTest extends TestCase
{
    /** @return array<string, string> relative path => contents */
    private function views(): array
    {
        $views = [];
        $root = resource_path('views');

        $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($root));
        foreach ($files as $file) {
            if ($file->isFile() && str_ends_with($file->getFilename(), '.blade.php')) {
                $views[str_replace($root . '/', '', $file->getPathname())] = file_get_contents($file->getPathname());
            }
        }

        ksort($views);

        return $views;
    }

    private function jqueryLoads(string $contents): array
    {
        preg_match_all('/<script[^>]*src="([^"]*jquery[^"]*)"/i', $contents, $matches);

        return $matches[1];
    }

    public function test_no_view_loads_more_than_one_jquery(): void
    {
        $offenders = [];

        foreach ($this->views() as $path => $contents) {
            $loads = $this->jqueryLoads($contents);

            if (count($loads) > 1) {
                $offenders[$path] = $loads;
            }
        }

        $this->assertSame([], $offenders, 'A second jQuery replaces the first, along with anything the page bound to it.');
    }

    public function test_no_view_loads_an_asset_over_plain_http(): void
    {
        $offenders = [];

        foreach ($this->views() as $path => $contents) {
            if (preg_match('/(?:src|href)="http:\/\/[^"]*/i', $contents, $m)) {
                $offenders[$path] = $m[0];
            }
        }

        $this->assertSame([], $offenders, 'Browsers block plain-http assets on an https page.');
    }

    public function test_no_view_using_ajax_is_left_on_the_slim_build(): void
    {
        $offenders = [];

        foreach ($this->views() as $path => $contents) {
            if (! preg_match('/\$\.(ajax|get|post)\(/', $contents)) {
                continue;
            }

            $loads = $this->jqueryLoads($contents);

            if ($loads !== [] && str_contains(end($loads), 'slim')) {
                $offenders[] = $path;
            }
        }

        $this->assertSame([], $offenders, 'The slim build has no $.ajax.');
    }

    /**
     * Bootstrap 4 and 5 were loaded together on 23 pages. They are not
     * compatible: 5 renamed every data attribute to data-bs-* and dropped the
     * jQuery plugin API this application drives its modals with, so whichever
     * ends up in control decides whether the markup works at all.
     *
     * Written as "one version, and it matches the markup" rather than
     * "Bootstrap 4", so migrating the markup later changes what this test
     * demands instead of failing it.
     */
    public function test_one_bootstrap_version_is_loaded_and_it_matches_the_markup(): void
    {
        $majors = [];
        $bs4Markup = 0;
        $bs5Markup = 0;

        foreach ($this->views() as $contents) {
            $bs4Markup += preg_match_all('/data-(?:toggle|dismiss|target|ride|parent)=/', $contents);
            $bs5Markup += preg_match_all('/data-bs-[a-z]+=/', $contents);

            preg_match_all('/<(?:script|link)[^>]*(?:src|href)="([^"]*bootstrap[^"]*)"/i', $contents, $matches);

            foreach ($matches[1] as $url) {
                if (preg_match('/bootstrap[@\/](\d)/', $url, $version)) {
                    $majors[$version[1]] = true;
                }
            }
        }

        ksort($majors);

        $this->assertCount(1, $majors, 'Loading two majors of Bootstrap together means neither is reliably in control. Found: ' . implode(', ', array_keys($majors)));

        // PHP casts numeric array keys to integers.
        $loaded = (string) array_key_first($majors);
        $expected = $bs5Markup > $bs4Markup ? '5' : '4';

        $this->assertSame($expected, $loaded, "The markup is Bootstrap {$expected} ({$bs4Markup} v4 attributes, {$bs5Markup} v5), but Bootstrap {$loaded} is loaded.");
    }
}
