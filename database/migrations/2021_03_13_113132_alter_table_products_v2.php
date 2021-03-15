<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableProductsV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Illuminate\Support\Facades\DB::table('products')->truncate();

        Schema::table('products', function (Blueprint $table) {
            $table->string('reference')->nullable()->after('name');
            $table->dropColumn('description');
            $table->renameColumn('type_id', 'type');
            $table->float('average_cost', 12, 4)->default(0)->after('state');
            $table->uuid('company_id')->after('average_cost');
            $table->unsignedInteger('created_by')->after('company_id');
            $table->unsignedInteger('updated_by')->after('created_by');
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
            $table->dropColumn('reference');
            $table->string('description')->nullable();
            $table->renameColumn('type', 'type_id');
            $table->dropColumn('average_cost');
            $table->dropColumn('company_id');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
}
