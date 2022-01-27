<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicketBooking extends Model
{
    //
    use HasFactory;
    protected $tablename = "event_ticket_bookings";
    protected $fillable = ['user_id','event_id','total_price','vat','discount'];

    public function event(){
        return $this->belongsTo(Event::class,'event_id' ,'id')->select('id','event_title');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id' ,'id')->select('id','full_name','email','avatar');
    }
    public function event_ticket_booking_details(){
        return $this->hasMany(EventTicketBookingDetail::class,'event_ticket_booking_id','id');
    }
}
