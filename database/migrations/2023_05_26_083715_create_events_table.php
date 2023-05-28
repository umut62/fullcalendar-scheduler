<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->timestamps();
        });

        DB::table('events')->insert([
            [
                'title' => 'Example Event 1',
                'start' => '2023-05-27 10:00:00',
                'end' => '2023-05-27 12:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Example Event 2',
                'start' => '2023-05-28 14:00:00',
                'end' => '2023-05-28 16:00:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};