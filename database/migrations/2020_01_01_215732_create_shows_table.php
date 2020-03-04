<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shows', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('ticketing_provider_id')->nullable()->unique();
            $table->string('shows_provider_id')->nullable();
            $table->string('title');
            $table->string('genre')->nullable();
            $table->unsignedInteger('duration_in_seconds')->nullable();
            $table->string('country')->nullable();
            $table->unsignedSmallInteger('year')->nullable();
            $table->string('director')->nullable();
            $table->string('cast')->nullable();
            $table->text('synopsis')->nullable();
            $table->tinyInteger('audience')->nullable();
            $table->unsignedInteger('poster_version')->default(1);
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
        Schema::dropIfExists('shows');
    }
}
