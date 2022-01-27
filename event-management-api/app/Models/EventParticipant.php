<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    //
    use HasFactory;
    protected $tablename = "event_participants";
    protected $fillable = ['user_id','event_id','status'];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id')
            ->select('users.id','users.email','users.full_name','users.phone','users.avatar');
    }

}
