<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTicketBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_ticket_booking_details', function (Blueprint $table) {
            $table->id();
            $table->integer('event_ticket_booking_id');
            $table->integer('event_id');
            $table->integer('user_id');
            $table->integer('event_ticket_type_id')->default(0);
            $table->string('event_ticket_type')->nullable();
            $table->float('event_ticket_price')->default(0);
            $table->integer('event_ticket_qty')->default(0);
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
        Schema::dropIfExists('event_ticket_booking_details');
    }
}
