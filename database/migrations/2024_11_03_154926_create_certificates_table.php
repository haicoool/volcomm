<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id('certificateId');
            $table->unsignedBigInteger('registrationId'); // Assuming regId is unsigned big integer
            $table->string('oppTitle');
            $table->string('vName');
            $table->string('oppLocation');
            $table->string('logo');
            $table->string('oppDate');
            $table->string('signature');
            $table->string('signerName');
            $table->string('signerPosition');
            $table->timestamps();

            $table->foreign('registrationId')->references('regId')->on('registrations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
