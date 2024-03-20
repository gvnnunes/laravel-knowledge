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
        Schema::table('event_event_category', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['event_id']);
            $table->dropForeign(['event_category_id']);

            // Add new foreign key constraints with onDelete('cascade')
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('event_category_id')->references('id')->on('event_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
