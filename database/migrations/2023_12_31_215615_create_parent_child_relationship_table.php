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
        Schema::create('parent_child_relationship', function (Blueprint $table) {
            $table->foreignId('parent_id')->constrained('users');
            $table->foreignId('child_id')->constrained('users');
            $table->primary(['parent_id', 'child_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parent_child_relationship');
    }
};
