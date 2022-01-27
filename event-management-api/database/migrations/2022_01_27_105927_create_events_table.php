<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_title')->nullable();
            $table->text('event_description')->nullable();
            $table->string('event_avatar')->nullable();
            $table->date('event_start_date')->nullable();
            $table->string('event_start_time')->nullable();
            $table->date('event_end_date')->nullable();
            $table->string('event_end_time')->nullable();
            $table->string('event_lat')->nullable();
            $table->string('event_lng')->nullable();
            $table->text('event_location')->nullable();
            $table->tinyInteger('is_active')->default(1);
            $table->integer('created_by')->default(0);
            $table->integer('updated_by')->default(0);
             $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
