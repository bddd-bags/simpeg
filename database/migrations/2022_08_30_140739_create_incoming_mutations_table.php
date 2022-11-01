<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomingMutationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incoming_mutations', function (Blueprint $table) {
            $table->id();
            $table
            ->foreignId("user_id")
            ->constrained("users")
            ->onDelete("cascade")
            ->unique();
            $table->string('from', 180);
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
        Schema::dropIfExists('incoming_mutations');
    }
}
