<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'utype','full_name','email','avatar','phone','password','api_token','lat','lng','bio','device_type','device_token',
        'ip_address','is_active','is_blocked','points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Roll API Key
     */
    public function rollApiKey(){
        do{
            $this->api_token = Str::random(60);
        }while($this->where('api_token', $this->api_token)->exists());
        $this->save();
    }

    public function event_ticket_bookings(){
        return $this->hasMany(EventTicketBooking::class,'user_id','id');
    }
}
