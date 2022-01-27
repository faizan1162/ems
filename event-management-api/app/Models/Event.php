<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Auth;

/**
 * Class Event
 * @package App\Models
 */
class Event extends Model
{
    //
    use HasFactory;
    protected $table="events";
    protected $fillable=['event_title','event_description','event_avatar',
        'event_start_date','event_start_time','event_end_date','event_end_time','event_lat','event_lng','event_location','is_active','created_by','updated_by'
    ];

    public function user(){
        return $this->belongsTo(User::class,'created_by','id')
        ->select('users.id','users.email','users.full_name','users.phone','users.avatar','users.device_type','users.device_token');
    }
    public function event_tickets(){
        return $this->hasMany(EventTicket::class,'event_id','id');
    }
    public function event_ticket_bookings(){
        return $this->belongsToMany(User::class,EventTicketBooking::class,'event_id','user_id')
        ->select('users.id','users.email','users.full_name','users.phone','users.avatar','users.device_type','users.device_token');
    }
    public function participants(){
        return $this->belongsToMany(User::class,EventParticipant::class,'event_id','user_id')
            ->select('users.id','users.email','users.full_name','users.phone','users.avatar');
    }
    public function ticket_bookings(){
        return $this->hasMany(EventTicketBooking::class,'event_id','id');
    }
}
