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
        Schema::table('events', function (Blueprint $table) {
            Schema::table('events', function (Blueprint $table) {
                $table->unsignedBigInteger('admin_id');
                $table->foreign('admin_id')
                        ->references('id')
                        ->on('admins');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropIfExists('admin_id');
        });
    }
};
