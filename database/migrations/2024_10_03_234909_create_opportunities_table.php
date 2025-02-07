<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpportunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id('oppId');
            $table->foreignId('organizationId')->constrained('organizations', 'organizationId')->onDelete('cascade');
            $table->string('oppTitle');
            $table->text('oppDesc');
            $table->string('oppLocation');
            $table->date('oppDate');
            $table->time('oppTime');
            $table->string('reqSkill');
            $table->string('oppImage')->nullable();
            $table->integer('maxCapacity'); // Added maxCapacity field
            $table->integer('currentReg')->default(0); // Added currentReg with default value 0
            $table->boolean('reqQualification'); // Added reqQualification field
            $table->string('category'); // Added category field
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
        Schema::dropIfExists('opportunities');
    }
}
