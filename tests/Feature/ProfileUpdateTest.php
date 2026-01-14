<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_athlete_id_unique_validation()
    {
        // Create two users
        $user1 = User::factory()->create(['athlete_id' => '123']);
        $user2 = User::factory()->create(['athlete_id' => '456']);

        // Try to update user2 with athlete_id that already exists for user1
        $response = $this->actingAs($user2)->put(route('profile.update'), [
            'fname' => 'Test',
            'lname' => 'User',
            'email' => $user2->email,
            'athlete_id' => '123', // This should fail validation
        ]);

        $response->assertSessionHasErrors('athlete_id');
    }

    public function test_athlete_id_can_be_same_for_same_user()
    {
        // Create a user with athlete_id
        $user = User::factory()->create(['athlete_id' => '123']);

        // Update the same user with the same athlete_id (should pass)
        $response = $this->actingAs($user)->put(route('profile.update'), [
            'fname' => 'Updated',
            'lname' => 'Name',
            'email' => $user->email,
            'athlete_id' => '123', // Same as current, should be allowed
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'fname' => 'Updated',
            'athlete_id' => '123',
        ]);
    }
}
