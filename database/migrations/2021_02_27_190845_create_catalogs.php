<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCatalogs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalogs', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('tag');
            $table->string('value');
            $table->string('type');
            $table->string('module');
            $table->unsignedInteger('order');
        });

        \Illuminate\Support\Facades\DB::table('catalogs')
            ->insert([
                [
                    'id' => \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value(),
                    'tag' => 'active',
                    'value' => 'Active',
                    'type' => 'state',
                    'module' => 'companies',
                    'order' => 10
                ],
                [
                    'id' => \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value(),
                    'tag' => 'inactive',
                    'value' => 'Inactive',
                    'type' => 'state',
                    'module' => 'companies',
                    'order' => 20
                ]
            ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('catalogs');
    }
}
