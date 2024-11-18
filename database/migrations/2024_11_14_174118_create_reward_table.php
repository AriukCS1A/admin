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
        Schema::table('reward', function (Blueprint $table) {
            if (!Schema::hasColumn('reward', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('reward', 'info')) {
                $table->string('info');
            }
            if (!Schema::hasColumn('reward', 'productPhoto')) {
                $table->string('productPhoto');
            }
            if (!Schema::hasColumn('reward', 'requiredAge')) {
                $table->integer('requiredAge');
            }
            if (!Schema::hasColumn('reward', 'maxAge')) {
                $table->integer('requiredMonth');
            }
            if (!Schema::hasColumn('reward', 'validFrom')) {
                $table->date('validFrom');
            }
            if (!Schema::hasColumn('reward', 'validTo')) {
                $table->date('validTo');
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
        Schema::table('reward', function (Blueprint $table) {
            if (Schema::hasColumn('reward', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('reward', 'info')) {
                $table->dropColumn('info'); // Corrected typo here
            }
            if (Schema::hasColumn('reward', 'productPhoto')) {
                $table->dropColumn('productPhoto');
            }
            if (Schema::hasColumn('reward', 'requiredAge')) {
                $table->dropColumn('requiredAge');
            }
            if (Schema::hasColumn('reward', 'requiredMonth')) {
                $table->dropColumn('requiredMonth');
            }
            if (Schema::hasColumn('reward', 'validFrom')) {
                $table->dropColumn('validFrom');
            }
            if (Schema::hasColumn('reward', 'validTo')) {
                $table->dropColumn('validTo');
            }
        });
    }
};
