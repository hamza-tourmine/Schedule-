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
        Schema::create('group_and_module_has_formateur', function (Blueprint $table){
            $table->unsignedBigInteger('group_id');
            $table->foreign('group_id')
                ->references('id')
                ->on('groups')
                ->onDelete('cascade');

            $table->unsignedBigInteger('module_id');
            $table->foreign('module_id')
                ->references('id')
                ->on('modules')
                ->onDelete('cascade')
                ->onUpdate('cascade');

                $table->unsignedBigInteger('establishment_id');
                $table->foreign('establishment_id')
                    ->references('id')
                    ->on('establishment')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                    $table->unsignedBigInteger('formateur_id');
                    $table->foreign('formateur_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');

                    $table->enum('status',['encoure','fin']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_has_modules');

    }
};
