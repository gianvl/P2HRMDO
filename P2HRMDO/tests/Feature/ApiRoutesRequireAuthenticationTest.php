<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

/**
 * The /api routes are the web application's own AJAX endpoints. They were
 * reachable without a session, so any college's manpower and evaluation figures
 * were readable by anyone who knew a URL.
 */
class ApiRoutesRequireAuthenticationTest extends TestCase
{
    /** Sanctum's stock /api/user route guards itself with its own driver. */
    private const GUARDED_ELSEWHERE = ['api/user'];

    /**
     * Written against the route table rather than a fixed list, so a new
     * endpoint added without authentication fails this test.
     */
    public function test_every_api_route_is_behind_authentication(): void
    {
        $unprotected = [];

        foreach (Route::getRoutes() as $route) {
            if (! str_starts_with($route->uri(), 'api/')) {
                continue;
            }

            if (in_array($route->uri(), self::GUARDED_ELSEWHERE, true)) {
                continue;
            }

            $middleware = $route->gatherMiddleware();

            if (! in_array('auth', $middleware, true)) {
                $unprotected[] = $route->uri();
            }
        }

        $this->assertSame([], $unprotected, 'These /api routes are reachable without logging in.');
    }

    public function test_api_routes_start_a_session_so_auth_can_see_the_logged_in_user(): void
    {
        $route = collect(Route::getRoutes())->first(
            fn ($r) => str_starts_with($r->uri(), 'api/processing/forecastingdata')
        );

        $this->assertNotNull($route);
        $this->assertContains(
            'web',
            $route->gatherMiddleware(),
            'Without the web group there is no session, so auth can never see a logged-in user.'
        );
    }

    public function test_a_guest_cannot_read_forecasting_data(): void
    {
        $this->getJson('/api/processing/forecastingdata/CBA/Accountancy/2024-2025/1st Semester')
            ->assertUnauthorized();
    }

    public function test_a_guest_cannot_read_department_or_professor_data(): void
    {
        $this->getJson('/api/college/CBA/department')->assertUnauthorized();
        $this->getJson('/api/professor/1')->assertUnauthorized();
    }

    public function test_a_guest_cannot_post_an_evaluation(): void
    {
        $this->postJson('/api/evaluation/post', ['employee_id' => 1])->assertUnauthorized();
    }

    /**
     * The other half of the guarantee: locking guests out must not lock users
     * out. Asserted as "not rejected" rather than "200" so the test holds with
     * or without a database -- without one the request still reaches the
     * controller and fails there, which is itself the proof that it got past
     * the auth middleware.
     */
    public function test_a_logged_in_user_is_let_through(): void
    {
        $response = $this->actingAs(new User())
            ->getJson('/api/processing/forecastingdata/CBA/Accountancy/2024-2025/1st Semester');

        $this->assertNotSame(401, $response->status(), 'A logged-in user was rejected.');
        $this->assertNotSame(302, $response->status(), 'A logged-in user was redirected to login.');
    }
}
