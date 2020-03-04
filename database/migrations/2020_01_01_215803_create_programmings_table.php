<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgrammingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('programmings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('week_id');
            $table->unsignedBigInteger('show_id');
            $table->unsignedTinyInteger('order')->nullable();
            $table->boolean('is_dubbed_version')->default(false);
            $table->boolean('is_original_version')->default(false);
            $table->boolean('is_2d')->default(false);
            $table->boolean('is_3d')->default(false);
            $table->text('custom_showings_infos')->nullable();
            $table->timestamps();

            $table->foreign('week_id')->references('id')->on('weeks')->onDelete('cascade');
            $table->foreign('show_id')->references('id')->on('shows')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('programmings');
    }
}
