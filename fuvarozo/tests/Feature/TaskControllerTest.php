<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Task;
use App\Models\Vehicle;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_task()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
    
        $this -> actingAs($user);
    
        $response = $this->post('/createjob', [
            'starting_address' => 'Test Address 1',
            'ending_address' => 'Test Address 2',
            'person_name' => 'John Doe',
            'phone_number' => '123456789',
            'driver_id' => $user -> id,
        ]);
    
        $this->assertDatabaseHas('tasks', [
            'starting_address' => 'Test Address 1',
            'ending_address' => 'Test Address 2',
            'driver_id' => $user -> id,
        ]);
    
        $response->assertRedirect('/adminview');
    }

    /** @test */
    public function update_task()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
        ]);
        $this->actingAs($user);
    
        $task = Task::create([
            'starting_address' => 'Old Address',
            'ending_address' => 'Old Address 2',
            'person_name' => 'Jane Doe',
            'phone_number' => '987654321',
            'driver_id' => $user -> id,
            'status' => 'assigned',
        ]);
    
        $response = $this -> post('/editJob', [
            'id' => $task -> id,
            'starting_address' => 'New Address',
            'ending_address' => 'New Address 2',
            'person_name' => 'Jane Smith',
            'phone_number' => '123456789',
        ]);
    
        $this->assertDatabaseHas('tasks', [
            'id' => $task -> id,
            'starting_address' => 'New Address',
            'ending_address' => 'New Address 2',
            'person_name' => 'Jane Smith',
            'phone_number' => '123456789',
        ]);
    
        $response->assertRedirect('/adminview');
    }

    /** @test */
    public function assign_driver()
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123'),
            'role' => 'admin',
        ]);
    
        $driver = User::create([
            'name' => 'Driver User',
            'email' => 'driver@driver.com',
            'password' => bcrypt('driver123'),
            'role' => 'driver',
        ]);
    
        $task = Task::create([
            'starting_address' => 'Test Address',
            'ending_address' => 'Test Address 2',
            'person_name' => 'John Doe',
            'phone_number' => '123456789',
            'status' => 'assigned',
        ]);
    
        $this->actingAs($admin);
    
        $response = $this->post('/assignjob', [
            'id' => $task->id,
            'driver_id' => $driver->id,
        ]);
    
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'driver_id' => $driver->id,
        ]);
    
        $response->assertRedirect('/adminview');
    }

    /** @test */
    public function change_status()
    {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'user@test.com',
            'password' => bcrypt('password123'),
            'role' => 'driver',
        ]);
        $this->actingAs($user);
    
        $task = Task::create([
            'starting_address' => 'Address 1',
            'ending_address' => 'Address 2',
            'person_name' => 'John Doe',
            'phone_number' => '123456789',
            'driver_id' => $user->id,
            'status' => 'assigned',
        ]);
    
        $response = $this->post('/changestatus', [
            'id' => $task->id,
            'status' => 'in-progress',
        ]);
    
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => 'in-progress',
        ]);
    
        $response->assertRedirect('/driverview');
    }
}