<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('code');
            $table->string('household');
            $table->string('philhealth');
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('extension');
            $table->enum('sex', [0,1]);
            $table->string('birthreg');
            $table->date('birthdate');
            $table->bigInteger('age');
            $table->string('education');
            $table->string('region');
            $table->string('province');
            $table->string('municipality');
            $table->string('barangay');
            $table->string('sitio');
            $table->integer('ethnicity_id');
            $table->string('relhh');
            $table->string('leader');
            $table->string('isIP');
            $table->string('isLeader');
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
        Schema::dropIfExists('people');
    }
}
