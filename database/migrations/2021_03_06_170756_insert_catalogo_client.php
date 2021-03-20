<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertCatalogoClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        \Illuminate\Support\Facades\DB::table('catalogs')
            ->insert([
                [
                    'id' => \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value(),
                    'tag' => 'active',
                    'value' => 'Active',
                    'type' => 'state',
                    'module' => 'clients',
                    'order' => 10
                ],
                [
                    'id' => \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value(),
                    'tag' => 'inactive',
                    'value' => 'Inactive',
                    'type' => 'state',
                    'module' => 'clients',
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
        \Illuminate\Support\Facades\DB::table('catalogs')
            ->where('type', 'state')
            ->where('module', 'clients')
            ->delete();
    }
}
