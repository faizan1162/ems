<?php
namespace App\Services;
use App\Contracts\UserInterface;
use App\Models\EventParticipant;
use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return User::find($id);
        // TODO: Implement find() method.
    }

    /**
     * @return mixed
     */
    public function getAll()
    {
        return User::select('id','full_name','email','avatar','phone_code','phone','utype','is_artist','is_active')->where('utype','!=',1)->latest('id');
        // TODO: Implement getAll() method.
    }

    /**
     * @param $request
     */
    public function save($request)
    {
        // TODO: Implement save() method.
    }

    /**
     * @param $event_id
     * @return mixed
     */
    public function getNotParticipatedUserList($event_id){
        $userIds = EventParticipant::where('event_id',$event_id)->pluck('user_id')->toArray();
        if(count($userIds)){
            return User::whereNotIn('id',$userIds)->where(['is_active'=>1,'utype'=>'user'])->select('id','full_name','email')->orderBy('id','desc')->get();
        }else{
            return User::where(['is_active'=>1,'utype'=>'user'])->select('id','full_name','email')->orderBy('id','desc')->get();
        }
    }
}