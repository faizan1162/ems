<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventTicketBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_ticket_bookings', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('user_id');
            $table->float('total_price')->default(0);
            $table->float('vat')->default(0);
            $table->float('discount')->default(0);
            $table->integer('created_by')->default(0);
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
        Schema::dropIfExists('event_ticket_bookings');
    }
}
