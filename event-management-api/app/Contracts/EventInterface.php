<?php
namespace App\Contracts;

/**
 * Interface EventInterface
 * @package App\Contracts
 */
interface EventInterface extends BaseInterface
{

    /**
     * @return mixed
     */
    public function completedEvents();

    /**
     * @return mixed
     */
    public function scheduledEvents();

    /**
     * @param $event_id
     * @param $user_id
     * @return mixed
     */
    public function findEventParticipant($event_id, $user_id);

    /**
     * @param $event_id
     * @param $user_id
     * @return mixed
     */
    public function addEventParticipant($event_id, $user_id);

    /**
     * @param $event_id
     * @return mixed
     */
    public function getEventParticipants($event_id);

    /**
     * @return mixed
     */
    public function getAllEventList();
}