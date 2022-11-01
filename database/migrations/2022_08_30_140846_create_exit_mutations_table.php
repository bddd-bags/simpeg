<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExitMutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exit_mutations', function (Blueprint $table) {
            $table->id();
            $table
            ->foreignId("user_id")
            ->constrained("users")
            ->onDelete("cascade")
            ->unique();
            $table->text('purpose_moving');
            $table->string('position', 100);
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
        Schema::dropIfExists('exit_mutations');
    }
}
