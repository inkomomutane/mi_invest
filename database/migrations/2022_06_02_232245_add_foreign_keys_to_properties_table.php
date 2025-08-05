<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->foreign(['neighborhood_id'], 'fk_properties_neighborhoods1')->references(['id'])->on('neighborhoods')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['condition_id'], 'fk_properties_conditions1')->references(['id'])->on('conditions')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['status_id'], 'fk_properties_statuses1')->references(['id'])->on('statuses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['property_type_id'], 'fk_properties_property_types1')->references(['id'])->on('property_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
            $table->foreign(['broker_id'], 'fk_properties_users1')->references(['id'])->on('users')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropForeign('fk_properties_neighborhoods1');
            $table->dropForeign('fk_properties_conditions1');
            $table->dropForeign('fk_properties_statuses1');
            $table->dropForeign('fk_properties_property_types1');
            $table->dropForeign('fk_properties_users1');
        });
    }
}
