<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banner', function (Blueprint $table) {
            // Add 'photo' column if not exists
            if (!Schema::hasColumn('banner', 'photo')) {
                $table->string('photo')->nullable(); // Зургийн URL
            }
            // Add 'public_id' column for Cloudinary
            if (!Schema::hasColumn('banner', 'public_id')) {
                $table->string('public_id')->nullable(); // Cloudinary public_id
            }
            // Add 'startDate' column
            if (!Schema::hasColumn('banner', 'startDate')) {
                $table->date('startDate');
            }
            // Add 'endDate' column
            if (!Schema::hasColumn('banner', 'endDate')) {
                $table->date('endDate');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banner', function (Blueprint $table) {
            // Drop only the columns added in this migration
            if (Schema::hasColumn('banner', 'photo')) {
                $table->dropColumn('photo');
            }
            if (Schema::hasColumn('banner', 'public_id')) {
                $table->dropColumn('public_id');
            }
            if (Schema::hasColumn('banner', 'startDate')) {
                $table->dropColumn('startDate');
            }
            if (Schema::hasColumn('banner', 'endDate')) {
                $table->dropColumn('endDate');
            }
        });
    }
};
