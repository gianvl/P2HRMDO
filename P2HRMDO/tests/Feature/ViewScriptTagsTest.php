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
}
