<?php
namespace App\Contracts;
/**
 * Interface BaseInterface
 * @package App\Contracts
 */
interface BaseInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * @return mixed
     */
    public function getAll();

    /**
     * @param $request
     * @return mixed
     */
    public function save($request);
}