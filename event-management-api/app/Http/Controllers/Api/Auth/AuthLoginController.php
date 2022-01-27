<?php
namespace App\Http\Controllers\Api\Auth;
use App\Contracts\CustomAuthInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

/**
 * Class AuthLoginController
 * @package App\Http\Controllers\Api\Auth
 */
class AuthLoginController extends Controller
{
    /**
     * @var CustomAuthInterface
     */
    private $customAuth;

    /**
     * AuthLoginController constructor.
     * @param CustomAuthInterface $customAuth
     */
    public function __construct(CustomAuthInterface $customAuth){
        $this->customAuth = $customAuth;
    }

    /**
     * @param LoginRequest $request
     * @return json
     */
    protected function login(LoginRequest $request) {
       return $this->customAuth->login($request);
    }

    /**
     * @return json
     */
    protected function logout(){
        return $this->customAuth->logout();
    }
}