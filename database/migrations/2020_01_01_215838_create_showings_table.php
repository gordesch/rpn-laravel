<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShowingsTable extends Migration
{
     protected const FIFTEEN_MINUTES_IN_SECONDS = 15 * 60;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('showings', function (Blueprint $table) {
            $table->id();
            $table->string('ticketing_provider_id');
            $table->unsignedBigInteger('programming_id');
            $table->datetime('datetime');
            $table->unsignedInteger('preshow_duration_in_seconds')
                ->default(self::FIFTEEN_MINUTES_IN_SECONDS);
            $table->boolean('is_original_version')->default(false);
            $table->boolean('is_3d')->default(false);
            $table->tinyInteger('auditorium_number');
            $table->timestamps();

            $table->index('datetime');
            $table->foreign('programming_id')
                ->references('id')
                ->on('programmings')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('showings');
    }
}
