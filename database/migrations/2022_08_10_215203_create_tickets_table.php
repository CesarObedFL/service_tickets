<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('problem', 30);
            $table->string('description');
            $table->enum('status', ['solved', 'in process', 'pending'])->default('pending');
            $table->enum('priority', ['high', 'medium', 'low'])->default('low');
            $table->foreignId('user_id')->constrained();
            $table->unsignedBigInteger('asigned_to')->nullable();
            $table->foreign('asigned_to')->nullable()->references('id')->on('users'); // support user id
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
        Schema::dropIfExists('tickets');
    }
};
