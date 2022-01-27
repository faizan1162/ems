<?php
namespace App\Contracts;
/**
 * Interface TicketBookingInterface
 * @package App\Contracts
 */
interface TicketBookingInterface extends BaseInterface
{

    /**
     * @param $event_id
     * @return mixed
     */
    public function getTicketBookingsByEvent($event_id);
}