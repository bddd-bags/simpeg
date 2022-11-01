<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_experiences', function (Blueprint $table) {
            $table->id();
            $table
            ->foreignId("user_id")
            ->constrained("users")
            ->onDelete("cascade");
            $table->string('name', 120);
            $table->text('description');
            $table->integer('start_year');
            $table->integer('end_year')->nullable();
            $table
            ->foreignId("place_id")
            ->constrained("places")
            ->onDelete("cascade");
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
        Schema::dropIfExists('job_experiences');
    }
}
