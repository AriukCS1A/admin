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
        Schema::table('account', function (Blueprint $table) {
            if (!Schema::hasColumn('account', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable();
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('account', 'accountNum')) {
                $table->string('accountNum')->unique()->nullable();
            }
            if (!Schema::hasColumn('account', 'totalAdd')) {
                $table->integer('totalAdd')->default(0);
            }
            if (!Schema::hasColumn('account', 'totalSub')) {
                $table->integer('totalSub')->default(0);
            }
            if (!Schema::hasColumn('account', 'balance')) {
                $table->integer('balance')->default(0);
            }
            if (!Schema::hasColumn('account', 'createTime') && !Schema::hasColumn('account', 'updateTime')) {
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
        Schema::table('account', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'accountNum', 'totalAdd', 'totalSub', 'balance']);
            $table->dropTimestamps();
        });
    }
};
