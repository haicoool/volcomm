<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegistrationsTable extends Migration
{
    public function up()
    {
        Schema::create('registrations', function (Blueprint $table) {
            // Auto-incrementing primary key
            $table->id('regId');

            // Volunteer information
            $table->string('vName');
            $table->string('vSkill');
            $table->string('vQualification')->nullable();

            // Foreign key to opportunities
            $table->unsignedBigInteger('oppId');

            // Status of registration (e.g., 'registered', 'pending')
            $table->string('status')->default('pending');

            // Foreign key to volunteers
            $table->unsignedBigInteger('vId');

            // Timestamps
            $table->timestamps();

            // Set foreign keys
            $table->foreign('vId')->references('vId')->on('volunteers')->onDelete('cascade');
            $table->foreign('oppId')->references('oppId')->on('opportunities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('registrations', function (Blueprint $table) {
            // Drop foreign keys before dropping columns
            $table->dropForeign(['vId']);
            $table->dropForeign(['oppId']);
        });

        Schema::dropIfExists('registrations');
    }
}
