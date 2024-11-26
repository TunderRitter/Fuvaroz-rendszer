<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Task;
use App\Models\Vehicle;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_and_login()
    {
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role' => 'admin',
        ]);

        $driver = User::create([
            'name' => 'driver',
            'email' => 'driver@driver.com',
            'password' => bcrypt('driverpassword'),
            'role' => 'driver',
        ]);

        $this->actingAs($admin);

        $task = Task::create([
            'starting_address' => 'Address 1',
            'ending_address' => 'Address 2',
            'person_name' => 'John Doe',
            'phone_number' => '123456789',
            'driver_id' => $driver->id,
            'status' => 'assigned',
        ]);

        $vehicle = Vehicle::create([
            'brand' => 'Toyota',
            'type' => 'Sedan',
            'license_plate' => 'ABC123',
            'driver_id' => $driver->id,
        ]);

        $response = $this->get('/adminview');

        $response->assertStatus(200);

        $this->assertDatabaseHas('tasks', [
            'starting_address' => 'Address 1',
            'ending_address' => 'Address 2',
        ]);

        $this->assertDatabaseHas('vehicles', [
            'license_plate' => 'ABC123',
            'driver_id' => $driver->id,
        ]);
    }
}
