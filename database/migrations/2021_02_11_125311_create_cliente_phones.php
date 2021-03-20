<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientePhones extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_phones', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('number');
            $table->string('number_type');
            $table->uuid('client_id');
            $table->timestamps();
        });

        Schema::create('client_emails', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('email');
            $table->string('email_type');
            $table->uuid('client_id');
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
        Schema::dropIfExists('cliente_phones');
        Schema::dropIfExists('client_emails');
    }
}
