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
        Schema::create('tasks', function (Blueprint $table) {
            $table->string('task_id')->unique()->primary();
            $table->string('title');
            $table->text('description');
            $table->boolean('status');
            $table->date('due_date'); 
            $table->softDeletes();
            $table->timestamps();
            
            $table->string('catigory_id')
                ->constrained('catigorys','catigory_id')
                ->cascadeOnUpdate() // work - personal - urgent
                ->cascadeOnDelete();
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
        Schema::dropIfExists('tasks');
    }
};
