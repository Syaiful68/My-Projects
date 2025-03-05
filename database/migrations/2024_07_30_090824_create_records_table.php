<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_record', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('plat_id');
            $table->string('driver');
            $table->integer('cost');
            $table->integer('last_mile');
            $table->integer('first_mile');
            $table->string('description');
            $table->string('picture');
            $table->string('path_picture');
            $table->string('is_status')->default('Paid');
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_record');
    }
};
