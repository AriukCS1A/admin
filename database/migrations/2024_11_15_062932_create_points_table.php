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
        Schema::table('points', function (Blueprint $table) {
            if (!Schema::hasColumn('points', 'added')) {
                $table->integer('added')->default(0);
            }
            if (!Schema::hasColumn('points', 'subtracted')) {
                $table->integer('subtracted')->default(0);
            }
            if (!Schema::hasColumn('points', 'user_id')) {
                $table->unsignedBigInteger('user_id');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('points', 'createdTime') && !Schema::hasColumn('points', 'updatedTime')) {
                $table->timestamps();
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
        Schema::table('points', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['added', 'subtracted', 'user_id']);
            $table->dropTimestamps();
        });
    }
};
