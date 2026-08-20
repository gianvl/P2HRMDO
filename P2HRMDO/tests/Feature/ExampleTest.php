<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * The stock scaffolding asserted a 200 here, which never matched this
     * application: "/" redirects guests to the login screen.
     */
    public function test_the_root_url_sends_guests_to_the_login_screen(): void
    {
        $this->get('/')->assertRedirect(route('login'));
    }
}
