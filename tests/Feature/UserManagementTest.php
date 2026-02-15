<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_are_redirected_when_accessing_user_management(): void
    {
        $response = $this->get(route('users.index'));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_users_can_view_the_users_index(): void
    {
        $authenticatedUser = User::factory()->create();
        $listedUser = User::factory()->create([
            'name' => 'Listed User',
        ]);

        $response = $this->actingAs($authenticatedUser)->get(route('users.index'));

        $response
            ->assertSuccessful()
            ->assertSeeText('User Management')
            ->assertSeeText($listedUser->name);
    }

    public function test_authenticated_users_can_create_a_user(): void
    {
        $authenticatedUser = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->post(route('users.store'), [
            'name' => 'New Team Member',
            'email' => 'new-member@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('users.index'));

        $this->assertDatabaseHas('users', [
            'name' => 'New Team Member',
            'email' => 'new-member@example.com',
        ]);
    }

    public function test_authenticated_users_can_update_a_user(): void
    {
        $authenticatedUser = User::factory()->create();
        $managedUser = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->put(route('users.update', $managedUser), [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
            'password' => 'new-password',
            'password_confirmation' => 'new-password',
        ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect(route('users.index'));

        $managedUser->refresh();

        $this->assertSame('Updated Name', $managedUser->name);
        $this->assertSame('updated@example.com', $managedUser->email);
        $this->assertTrue(Hash::check('new-password', $managedUser->password));
    }

    public function test_authenticated_users_can_delete_another_user(): void
    {
        $authenticatedUser = User::factory()->create();
        $managedUser = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->delete(route('users.destroy', $managedUser));

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseMissing('users', ['id' => $managedUser->id]);
    }

    public function test_authenticated_users_can_not_delete_themselves(): void
    {
        $authenticatedUser = User::factory()->create();

        $response = $this->actingAs($authenticatedUser)->delete(route('users.destroy', $authenticatedUser));

        $response->assertRedirect(route('users.index'));
        $this->assertDatabaseHas('users', ['id' => $authenticatedUser->id]);
    }
}
