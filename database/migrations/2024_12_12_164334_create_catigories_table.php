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
        Schema::create('catigories', function (Blueprint $table) {
            // $table->id();
            $table->string('catigory_id')->unique()->primary();
            $table->string('catigory_name');
            $table->string('color');
            $table->softDeletes();
            $table->timestamps();

            $table->string('user_id')
                ->constrained('users','user_id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catigories');
    }
};
