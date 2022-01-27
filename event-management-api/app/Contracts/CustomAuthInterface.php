<?php
namespace App\Contracts;
/**
 * Interface CustomAuthInterface
 * @package App\Contracts
 */
interface CustomAuthInterface
{
    /**
     * @param $request
     * @return mixed
     */
    public function login($request);

    /**
     * @return mixed
     */
    public function logout();
}