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
            $table->id();
            $table->string('title');
            $table->text('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->dateTime('due_date');
            $table->enum('priority', ['low', 'medium', 'high']);
            $table->foreignId('status_id')->nullable()->constrained("task_statuses", "id")->cascadeOnDelete();
            $table->enum('status', ['To Do', 'In Progress', 'Done']);
            $table->foreignId('created_by')->constrained("users", "id")->cascadeOnDelete();
            $table->foreignId('assigned_to')->nullable()->constrained("users", "id")->cascadeOnDelete();
            $table->boolean('is_recurring')->default(false);
            $table->foreignId('recurring_task_id')->nullable()->constrained("recurring_tasks", "id")->cascadeOnDelete();
            $table->timestamps();
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
