<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('bathrooms')->nullable()->default(0);
            $table->decimal('price', 15, 2)->nullable()->default(0);
            $table->integer('year')->nullable();
            $table->integer('floors')->nullable()->default(0);
            $table->decimal('area', 10, 2)->nullable()->default(0);
            $table->integer('bedrooms')->nullable()->default(0);
            $table->integer('suites')->nullable()->default(0);
            $table->integer('garages')->nullable()->default(0);
            $table->integer('pools')->nullable()->default(0);
            $table->text('address')->nullable();
            $table->text('map')->nullable();
            $table->datetime('published_at')->nullable();
            $table->integer('views')->nullable()->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->unsignedBigInteger('neighborhood_id')->index('fk_properties_neighborhoods1_idx');
            $table->unsignedBigInteger('condition_id')->index('fk_properties_conditions1_idx');
            $table->unsignedBigInteger('property_type_id')->index('fk_properties_property_types1_idx');
            $table->unsignedBigInteger('status_id')->index('fk_properties_statuses1_idx');
            $table->unsignedBigInteger('broker_id')->index('fk_properties_users1_idx');
            $table->string('slug')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('properties');
    }
}
