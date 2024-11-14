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
          Schema::table('task', function (Blueprint $table) {
            if (!Schema::hasColumn('task', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('task', 'info')) {
                $table->text('info')->nullable();
            }
            if (!Schema::hasColumn('task', 'taskStart')) {
                $table->dateTime('taskStart');
            }
            if (!Schema::hasColumn('task', 'taskEnd')) {
                $table->dateTime('taskEnd');
            }
            if (!Schema::hasColumn('task', 'pic')) {
                $table->string('pic')->nullable();
            }
            if (!Schema::hasColumn('task', 'progress')) {
                $table->integer('progress')->default(0);
            }
            if (!Schema::hasColumn('task', 'filter_id')) {
                $table->foreignId('filter_id')->nullable()->constrained('filter');
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
         Schema::table('task', function (Blueprint $table) {
            if (Schema::hasColumn('task', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('task', 'info')) {
                $table->dropColumn('info');
            }
            if (Schema::hasColumn('task', 'taskStart')) {
                $table->dropColumn('taskStart');
            }
            if (Schema::hasColumn('task', 'taskEnd')) {
                $table->dropColumn('taskEnd');
            }
            if (Schema::hasColumn('task', 'pic')) {
                $table->dropColumn('pic');
            }
            if (Schema::hasColumn('task', 'progress')) {
                $table->dropColumn('progress');
            }

            if (Schema::hasColumn('task', 'filter_id')) {
                $table->dropForeign(['filter_id']);
                $table->dropColumn('filter_id');
            }
        });
    }
};
