<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProductsColumns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('products', 'barcode')) {
                $table->string('barcode')->unique();
            }
            if (!Schema::hasColumn('products', 'pic')) {
                $table->string('pic')->nullable();
            }
            if (!Schema::hasColumn('products', 'created_at') && !Schema::hasColumn('products', 'updated_at')) {
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
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'name')) {
                $table->dropColumn('name');
            }
            if (Schema::hasColumn('products', 'barcode')) {
                $table->dropColumn('barcode');
            }
            if (Schema::hasColumn('products', 'pic')) {
                $table->dropColumn('pic');
            }
            if (Schema::hasColumn('products', 'created_at') && Schema::hasColumn('products', 'updated_at')) {
                $table->dropTimestamps();
            }
        });
    }
}
