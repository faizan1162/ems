<?php
namespace App\Contracts;
/**
 * Interface CategoryInterface
 * @package App\Contracts
 */
interface CategoryInterface extends BaseInterface {
    /**
     * @param $request
     * @return mixed
     */
    public function updateCategory($request);
}