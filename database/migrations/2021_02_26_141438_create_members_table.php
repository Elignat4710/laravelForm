<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('firstName', 100);
            $table->string('lastName', 100);
            $table->date('birthdate');
            $table->string('reportSubject', 100);
            $table->string('phone', 50);
            $table->string('email')->unique();
            $table->string('company', 50)->nullable();
            $table->string('position', 50)->nullable();
            $table->text('aboutMe')->nullable();
            $table->text('photo')->nullable()->default(null);
            $table->boolean('hide')->default(0);

            $table->bigInteger('countryId')->unsigned();
            $table->foreign('countryId')
            ->references('id')->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
