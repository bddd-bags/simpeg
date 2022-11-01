<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table
            ->foreignId("user_id")
            ->constrained("users")
            ->onDelete("cascade");
            $table->string('fullname', 100)->nullable();
            $table->bigInteger('nip')->unique()->nullable();
            $table->bigInteger('nik')->unique()->nullable();
            $table
            ->foreignId("gender_id")
            ->default(1)
            ->constrained("genders")
            ->onDelete("cascade");
            $table->string('birth_place', 50)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('religion', 20)->nullable();
            $table->string('email_active', 100)->unique()->nullable();
            $table->text('address')->nullable();
            $table->string('no_telp', 14)->nullable();
            $table->string('picture')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
