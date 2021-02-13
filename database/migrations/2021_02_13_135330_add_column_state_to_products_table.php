<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnStateToProductsTable extends Migration
{

    public function up()
    {
        if (! Schema::hasColumn('products', 'state')) {
            Schema::table('products', function (Blueprint $table) {
                $table->string('state')->after('type_id');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('products', 'state')) {
            Schema::table('products', function (Blueprint $table) {
                $table->dropColumn('state');
            });
        }
    }
}
