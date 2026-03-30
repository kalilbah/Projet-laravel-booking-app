<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FilamentAdminPanelTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_page_is_available(): void
    {
        $this->get('/admin/login')
            ->assertOk();
    }

    public function test_authenticated_user_can_access_property_resource_index(): void
    {
        Property::factory()->create();
        $user = User::factory()->admin()->create();

        $this->actingAs($user)
            ->get('/admin/properties')
            ->assertOk();
    }

    public function test_admin_can_access_users_resource_index(): void
    {
        $user = User::factory()->admin()->create();

        $this->actingAs($user)
            ->get('/admin/users')
            ->assertOk();
    }

    public function test_non_admin_user_cannot_access_admin_panel(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get('/admin')
            ->assertForbidden();
    }
}
