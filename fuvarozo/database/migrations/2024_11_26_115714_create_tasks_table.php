<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('starting_address');
            $table->string('ending_address');
            $table->string('person_name');
            $table->string('phone_number');
            $table->enum('status', ['assigned', 'in-progress', 'completed', 'failed'])->default('assigned');
            $table->foreignId('driver_id') -> nullable() -> constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
