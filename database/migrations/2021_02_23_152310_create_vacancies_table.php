<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVacanciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('position')->nullable(false);
            $table->string('salary')->nullable();
            $table->text('link')->nullable();
            $table->text('contacts')->nullable(false);
            $table->enum('status', ['Contacted', 'Got a test task', 'Waiting for a feedback',
                                           'Screening', 'Technical review', 'Offer',
                                           'Refused', 'No response'])->nullable(false);
            $table->dateTime('status_last_update')->useCurrent();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('vacancies');
    }
}
