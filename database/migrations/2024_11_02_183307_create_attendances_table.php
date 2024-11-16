<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id(); // Creates the primary key column
            $table->unsignedBigInteger('regId'); // Ensure this column is defined
            $table->unsignedBigInteger('oppId'); // Ensure this column is defined
            $table->timestamps();

            // Define foreign key constraints after the columns are defined
            $table->foreign('regId')->references('regId')->on('registrations')->onDelete('cascade');
            $table->foreign('oppId')->references('oppId')->on('opportunities')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendances');
    }
}
