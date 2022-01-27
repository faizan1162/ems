<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    use HasFactory;
    protected $tablename = "event_tickets";
    protected $fillable = ['event_id','ticket_type_id','ticket_price','qty','sold_qty','created_by'];
    public function ticket_type(){
        return $this->belongsTo(TicketType::class,'ticket_type_id','id');
    }
}
