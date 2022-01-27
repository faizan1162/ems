<?php
namespace App\Contracts;
/**
 * Interface UserInterface
 * @package App\Contracts
 */
interface UserInterface extends BaseInterface
{

    /**
     * @param $event_id
     * @return mixed
     */
    public function getNotParticipatedUserList($event_id);
}