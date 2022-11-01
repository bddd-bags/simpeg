<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFamilysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('familys', function (Blueprint $table) {
            $table->id();
            $table
            ->foreignId("user_id")
            ->constrained("users")
            ->onDelete("cascade");
            $table
            ->foreignId("wedding_status_id")
            ->default(1)
            ->constrained("wedding_statuses")
            ->onDelete("cascade");
            $table->string('name', 100)->nullable();
            $table->string('work', 80)->nullable();
            $table->integer('amount_child')->nullable();
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
        Schema::dropIfExists('familys');
    }
}
