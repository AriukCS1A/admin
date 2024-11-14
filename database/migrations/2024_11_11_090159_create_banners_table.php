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
        // Only define columns you want to add or modify
        if (!Schema::hasColumn('banner', 'photo')) {
            $table->string('photo')->nullable(); // Add nullable if photo is optional
        }
        if (!Schema::hasColumn('banner', 'startDate')) {
            $table->date('startDate');
        }
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
        // Remove only the columns you added in this migration
        $table->dropColumn(['photo', 'startDate', 'endDate']);
    });
}
};
