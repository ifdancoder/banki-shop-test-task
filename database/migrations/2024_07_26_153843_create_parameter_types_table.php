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
        Schema::create('parameter_types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
        });
        DB::table('parameter_types')->insert([
            ['title' => '1-й тип'],
            ['title' => '2-й тип'],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parameter_types');
    }
};
