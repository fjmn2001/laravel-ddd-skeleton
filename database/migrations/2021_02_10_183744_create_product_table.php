<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTable extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid("id");
            $table->string("code")->unique();
            $table->string("name");
            $table->uuid("category_id");
            $table->string("description")->nullable();
            $table->uuid("type_id");
            $table->timestamps();

            $table->primary("id");
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}
