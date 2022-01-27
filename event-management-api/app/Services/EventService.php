<?php
namespace App\Services;
use App\Contracts\EventInterface;
use App\Models\Event;
use App\Models\EventParticipant;
use App\Models\EventTicket;
use Illuminate\Support\Facades\Auth;

/**
 * Class EventService
 * @package App\Services
 */
class EventService implements EventInterface
{

    /**
     * @var int
     */
    private $per_page = 25;

    /**
     * @param $id
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public function find($id)
    {
        // TODO: Implement find() method.
        return Event::with(['event_tickets.ticket_type','ticket_bookings'])->withCount(['participants','ticket_bookings'])->find($id);
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAll()
    {
        // TODO: Implement getAll() method.
        return Event::with(['event_tickets.ticket_type','event_ticket_bookings'])->orderBy('id', 'DESC')->paginate($this->per_page);
    }

    /**
     * @param $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function save($request)
    {
        // TODO: Implement save() method.

        try {
            $eventArr = [
                "event_title" => trim($request->input("event_title")),
                "event_description" => trim($request->input("event_description")),
                "event_start_date" => date("Y-m-d", strtotime($request->input("event_start_date"))),
                "event_start_time" => $request->input("event_start_time"),
                "event_end_date" => date("Y-m-d", strtotime($request->input("event_end_date"))),
                "event_end_time" => $request->input("event_end_time"),
                "event_lat" => $request->input("lat"),
                "event_lng" => $request->input("lng"),
                "event_location" => $request->input("event_location"),
                "is_active" => 1,
                "created_by" => Auth::user()->id
            ];
            if ($request->hasFile('event_avatar')) {
               $eventArr['event_avatar'] = uploadImage($request->file('event_avatar'), 400, 400);
            }
            if( $request->has('event_tickets')){
                $event = Event::create($eventArr);
                if(! empty($event)) {
                    $ticketInfo = [];
                    foreach ($request->event_tickets as $ticket) {
                        $ticketInfo[] = [
                            'event_id' => $event->id,
                            'ticket_type_id' => $ticket['ticket_type_id'],
                            'ticket_price' => $ticket['ticket_price'],
                            'qty' => $ticket['qty'],
                            'created_by' => Auth::user()->id
                        ];
                    }
                    if (count($ticketInfo)) {
                        EventTicket::insert($ticketInfo);
                    }
                }else{
                    return commonErrorMessage("Event Not Created, Please try again");
                }
            }else{
                return commonErrorMessage("Please Enter Ticket Details");
            }
            return apiSuccessMessage("Event created successfully");
        } catch (Exception $e) {
            return commonErrorMessage($e->getMessage());
        }
    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function completedEvents()
    {
        // TODO: Implement completedEvents() method.
        return Event::with(['event_tickets.ticket_type','event_ticket_bookings'])->whereDate('event_end_date','<',date('Y-m-d'))->orderBy('id', 'DESC')->paginate($this->per_page);

    }

    /**
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function scheduledEvents()
    {
        // TODO: Implement scheduledEvents() method.
        return Event::with(['event_tickets.ticket_type','event_ticket_bookings'])->whereDate('event_start_date','>',date('Y-m-d'))->orderBy('id', 'DESC')->paginate($this->per_page);
    }

    /**
     * @param $event_id
     * @param $user_id
     * @return mixed
     */
    public function findEventParticipant($event_id, $user_id){
        return EventParticipant::where(['event_id'=>$event_id,"user_id"=>$user_id])->first();
    }

    /**
     * @param $event_id
     * @param $user_id
     * @return mixed
     */
    public function addEventParticipant($event_id, $user_id){
        return EventParticipant::create(['event_id'=>$event_id,"user_id"=>$user_id]);
    }

    /**
     * @param $event_id
     */
    public function getEventParticipants($event_id){
        return EventParticipant::with(['user'])->where('event_id',$event_id)->orderBy('id','desc')->paginate(25);
    }
}