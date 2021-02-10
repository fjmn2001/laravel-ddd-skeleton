<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('lastname');
            $table->string('dni');
            $table->string('dni_type');
            $table->string('client_type')->nullable(true);
            $table->string('client_category')->nullable(true);
            $table->string('frequent_client_number')->nullable(true);
            $table->string('state');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
