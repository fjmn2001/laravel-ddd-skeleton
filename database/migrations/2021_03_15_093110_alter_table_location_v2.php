<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableLocationV2 extends Migration
{
    public function up()
    {
        Schema::dropIfExists('location');
        Schema::create('locations', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('code');
            $table->string('name');
            $table->string('main_contact');
            $table->string('barcode')->nullable();
            $table->string('address');
            $table->string('item_state');
            $table->string('state');
            $table->uuid('company_id');
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by');
            $table->timestamps();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('locations');
    }
}
