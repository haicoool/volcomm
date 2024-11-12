<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteersTable extends Migration
{
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id('vId'); // Primary key
            $table->string('vName');
            $table->string('vEmail')->unique();
            $table->string('vPass'); // Password will be stored as a hash
            $table->string('vSkill')->nullable();
            $table->string('vProfilepic')->nullable(); // Path to profile picture
            $table->json('vQualification')->nullable(); // JSON-encoded array of file paths for qualifications
            $table->json('interest')->nullable(); // JSON-encoded array of interests
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('volunteers');
    }
}
