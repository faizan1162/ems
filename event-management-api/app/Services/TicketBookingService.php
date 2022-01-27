<?php
namespace App\Services;
use App\Contracts\TicketBookingInterface;
use App\Models\EventTicket;
use App\Models\EventTicketBooking;
use App\Models\EventTicketBookingDetail;
use Illuminate\Support\Facades\DB;

class TicketBookingService implements TicketBookingInterface
{

    /**
     * @var int
     */
    private $per_page = 25;

    /**
     * @param $id
     */
    public function find($id)
    {
        // TODO: Implement find() method.
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
        return EventTicketBooking::with(['event','user','event_ticket_booking_details'])->orderBy('id','desc')->paginate($this->per_page);
    }

    /**
     * @param $event_id
     * @return mixed
     */
    public function getTicketBookingsByEvent($event_id){
        return EventTicketBooking::where('event_id',$event_id)->orderBy('id','desc')->paginate($this->per_page);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save($request)
    {
        // TODO: Implement save() method.
        DB::beginTransaction();
        if(! empty($etbooked = $this->findFirst($request->event_id,$request->user_id))){
            return commonErrorMessage("Ticked Already Booked");
        }
        try {
            $arr = [
                'event_id' => $request->event_id,
                'user_id' => $request->user_id,
                'total_price' => $request->total_price,
            ];
            $etb = EventTicketBooking::create($arr);
            if (!empty($etb)) {
                /** Save Event Ticket Booking Details */
                $arrEtbd = [
                    'event_ticket_booking_id' => $etb->id,
                    'event_id' => $request->event_id,
                    'user_id' => $request->user_id,
                    'event_ticket_type_id' => $request->event_ticket_type_id,
                    'event_ticket_type' => $request->event_ticket_type,
                    'event_ticket_price' => $request->event_ticket_price,
                    'event_ticket_qty' => $request->event_ticket_qty
                ];
                EventTicketBookingDetail::create($arrEtbd);
                /** update particpant status */
                $eventService = new EventService();
                //$participant = EventParticipant::where(['event_id' => $request->event_id, 'user_id' => $request->user_id])->first();
                $participant = $eventService->findEventParticipant($request->event_id,$request->user_id);
                if (!empty($participant)) {
                    $participant->status = 1;
                    $participant->save();
                }
                /** Update the event ticket sold count */
                $evTicket = EventTicket::where(["event_id" => $request->event_id, 'ticket_type_id' => $request->event_ticket_type_id])->first();
                if (!empty($evTicket)) {
                    $evTicket->sold_qty += $request->event_ticket_qty;
                    $evTicket->save();
                }
                DB::commit();
                return apiSuccessMessage("Ticked Booked Successfully");
            } else {
                return commonErrorMessage("Ticket Not Created");
            }
        }catch(Exception $e){
            DB::rollback();
            return commonErrorMessage($e->getMessage());
        }
    }

    /**
     * @param $event_id
     * @param $user_id
     * @return mixed
     */
    public function findFirst($event_id, $user_id){
        return EventTicketBooking::where(['event_id'=>$event_id,'user_id'=>$user_id])->first();
    }
}