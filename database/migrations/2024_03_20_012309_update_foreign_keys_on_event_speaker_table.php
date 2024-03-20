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
        Schema::table('event_speaker', function (Blueprint $table) {
            // Drop existing foreign key constraints
            $table->dropForeign(['event_id']);
            $table->dropForeign(['speaker_id']);

            // Add new foreign key constraints with onDelete('cascade')
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('speaker_id')->references('id')->on('speakers')->onDelete('cascade');
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
