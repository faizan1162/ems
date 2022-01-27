<?php
namespace App\Services;
use App\Contracts\CustomAuthInterface;
use Illuminate\Support\Facades\Auth;

class CustomAuthService implements CustomAuthInterface
{

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login($request){
        // TODO: Implement login() method.
        $userdata = array(
            'email' => $request->email,
            'password' => $request->password,
            'utype' => 'admin'
        );
        if (Auth::attempt($userdata)) {
            $user = Auth::user();
            $user->save();
            $user->rollApiKey();
            return $this->loginResponse($user);
        } else{
            return commonErrorMessage("Invalid credentials, Please try again",[],200);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        // TODO: Implement logout() method.
        $user = Auth::user();
        if(! empty($user)){
            $user->api_token = Null;
            $user->save();
        }
        return apiSuccessMessage("Admin Logout Successfully");
    }

    /**
     * @param $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function loginResponse($user){
        $data = array(
            "token" => $user->api_token,
            "id" => $user->id,
            "full_name" => $user->full_name,
            "email" => $user->email,
            "phone" => $user->phone,
            "avatar" => $user->avatar,
            "utype" => $user->utype,
            "device_type" => $user->device_type,
            "device_token" => $user->device_token
        );
        return apiSuccessMessage("Login Successfully", $data,200);
    }
}