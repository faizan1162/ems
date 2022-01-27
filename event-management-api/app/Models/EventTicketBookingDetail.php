<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicketBookingDetail extends Model
{
    use HasFactory;
    protected $tablename = "event_ticket_booking_details";
    protected $fillable = ['event_ticket_booking_id','user_id','event_id','event_ticket_type_id','event_ticket_type','event_ticket_price','event_ticket_qty'];
}
