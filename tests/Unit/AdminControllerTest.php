<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_dashboard()
    {
        Queue::fake();

        $admin = User::factory()->admin()->create();

        $this->actingAs($admin);

        $response = $this->get(route('admin.dashboard'));

        $response->assertStatus(200);
    }

    public function test_admin_can_delete_user(){
         $admin = User::factory()->admin()->create();
         $user = User::factory()->user()->create();

         $this->actingAs($admin);

         $response = $this->delete(route('admin.user.destroy', $user));

         $response->assertRedirect(route('admin.dashboard'));

         $this->assertDatabaseMissing('users', ['id'=> $user->id]);
    }

}