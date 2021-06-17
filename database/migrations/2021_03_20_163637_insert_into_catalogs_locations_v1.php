<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertIntoCatalogsLocationsV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $rows = [
            [
                'id' => \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value(),
                'tag' => 'active',
                'value' => 'Active',
                'type' => 'state',
                'module' => 'locations',
                'order' => 10
            ],
            [
                'id' => \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value(),
                'tag' => 'inactive',
                'value' => 'Inactive',
                'type' => 'state',
                'module' => 'locations',
                'order' => 20
            ],
            [
                'id' => \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value(),
                'tag' => 'available',
                'value' => 'Available',
                'type' => 'itemState',
                'module' => 'locations',
                'order' => 10
            ],
            [
                'id' => \Medine\ERP\Shared\Domain\ValueObjects\Uuid::random()->value(),
                'tag' => 'not_available',
                'value' => 'Not available',
                'type' => 'itemState',
                'module' => 'locations',
                'order' => 20
            ]
        ];
        \Illuminate\Support\Facades\DB::table('catalogs')
            ->insert($rows);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Illuminate\Support\Facades\DB::table('catalogs')
            ->whereIn('type', ['state', 'itemState'])
            ->where('module', 'locations')
            ->delete();
    }
}
