<?php

namespace App\Http\Controllers\Api\Event;

use App\Contracts\TicketBookingInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreEventTicketRequest;

/**
 * Class TicketBookingController
 * @package App\Http\Controllers\Api\Event
 */
class TicketBookingController extends Controller
{

    /**
     * @var TicketBookingInterface
     */
    private $ticketBookingInterface;

    /**
     * TicketBookingController constructor.
     * @param TicketBookingInterface $ticketBookingInterface
     */
    public function __construct(TicketBookingInterface $ticketBookingInterface)
    {
        $this->ticketBookingInterface = $ticketBookingInterface;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $bookings = $this->ticketBookingInterface->getAll();
        return apiSuccessMessage("All Ticket Booking Data",$bookings);
    }

    /**
     * @param StoreEventTicketRequest $request
     * @return mixed
     */
    public function store(StoreEventTicketRequest $request){
        return $this->ticketBookingInterface->save($request);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getTicketBookingsByEvent($id){
        $bookings = $this->ticketBookingInterface->getTicketBookingsByEvent($id);
        return apiSuccessMessage("Event Ticket Booking Data",$bookings);
    }
}
