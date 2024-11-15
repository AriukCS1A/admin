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
        Schema::table('baby', function (Blueprint $table) {
            if (!Schema::hasColumn('baby', 'babyName')) {
                $table->string('babyName');
            }
            if (!Schema::hasColumn('baby', 'register')) {
                $table->string('register');
            }
            if (!Schema::hasColumn('baby', 'gender')) {
                $table->string('gender');
            }
            if (!Schema::hasColumn('baby', 'bDay')) {
                $table->date('bDay');
            }
             if (!Schema::hasColumn('baby', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained('users');
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
        Schema::table('baby', function (Blueprint $table) {
            if (Schema::hasColumn('baby', 'babyName')) {
                $table->dropColumn('babyName');
            }
            if (Schema::hasColumn('baby', 'register')) {
                $table->dropColumn('register'); // Corrected typo here
            }
            if (Schema::hasColumn('baby', 'gender')) {
                $table->dropColumn('gender');
            }
            if (Schema::hasColumn('baby', 'bDay')) {
                $table->dropColumn('bDay');
            }
        });
    }
};
