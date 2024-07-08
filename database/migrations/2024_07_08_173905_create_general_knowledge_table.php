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
        Schema::create('general_knowledge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses')->restrictOnDelete();
            $table->enum('type', ['static', 'current affairs'])->default('current affairs');
            $table->longText('description')->nullable();
            $table->decimal('order')->default(0.00);
            $table->boolean('status');
            $table->foreignId('created_by')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_knowledge');
    }
};
