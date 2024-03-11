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
    Schema::create('request_emplois', function (Blueprint $table) {
        $table->id();
        $table->date('date_request');
        $table->string('comment', 450);
        $table->unsignedBigInteger('formateur_id');
        $table->foreign('formateur_id')
            ->references('id')
            ->on('users')
            ->onDelete('cascade')
            ->onUpdate('cascade');
        $table->timestamps(); // Add timestamps for created_at and updated_at
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_emplois');
    }
};
