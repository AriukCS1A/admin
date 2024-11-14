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
    Schema::table('filter', function (Blueprint $table) {
        // Only define columns you want to add or modify
        if (!Schema::hasColumn('filter', 'filter')) {
            $table->string('filter'); // Add nullable if photo is optional
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
    Schema::table('filter', function (Blueprint $table) {
        // Remove only the columns you added in this migration
        $table->dropColumn(['filter']);
    });
}
};
