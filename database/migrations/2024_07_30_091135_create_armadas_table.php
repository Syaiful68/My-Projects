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
        Schema::create('tb_armada', function (Blueprint $table) {
            $table->id();
            $table->string('nik');
            $table->string('owner');
            $table->string('address');
            $table->string('plat_number');
            $table->string('fuel');
            $table->string('vehicle');
            $table->string('contract_date');
            $table->string('contract_path');
            $table->string('contract');
            $table->boolean('is_status', [0, 1])->default(false);
            $table->string('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_armada');
    }
};
