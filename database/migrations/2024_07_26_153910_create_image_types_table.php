<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('image_types', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
        });
        DB::table('image_types')->insert([
            ['title' => 'icon'],
            ['title' => 'icon_gray'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('image_types');
    }
};
