<?php
namespace App\Http\Controllers\Api\Event;
use App\Contracts\EventInterface;
use App\Contracts\UserInterface;
use App\Http\Requests\Event\AddEventParticipantRequest;
use App\Http\Requests\Event\StoreEventRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class EventController
 * @package App\Http\Controllers\Api\Event
 */
class EventController extends Controller
{
    /**
     * @var EventInterface
     */
    private $eventInterface;

    /**
     * @var UserInterface
     */
    private $userInterface;
    /**
     * EventController constructor.
     * @param EventInterface $eventInterface
     */
    public function __construct(EventInterface $eventInterface, UserInterface $userInterface){
        $this->eventInterface = $eventInterface;
        $this->userInterface = $userInterface;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $type = "";
        if($request->has('type')){
            $type = $request->type;
        }
        if($type == "completed"){
            $events = $this->eventInterface->completedEvents();
        }else if($type == "scheduled"){
            $events = $this->eventInterface->scheduledEvents();
        }else{
            $events = $this->eventInterface->getAll();
        }
        return apiSuccessMessage("Event Data",$events);
    }

    /**
     * @param StoreEventRequest $request
     * @return mixed
     */
    public function store(StoreEventRequest $request){
        //return $request->event_tickets;
        return $this->eventInterface->save($request);
    }

    /**
     * @param $id
     */
    public function show($id){
        $event =  $this->eventInterface->find($id);
        $users = $this->userInterface->getNotParticipatedUserList($id);
        $event->users = $users;
        return apiSuccessMessage("Event Details",$event);
    }

    /**
     * @param AddEventParticipantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addParticipant(AddEventParticipantRequest $request){
        if(! empty($eventParticipant = $this->eventInterface->findEventParticipant($request->event_id,$request->user_id))){
            return commonErrorMessage("Already Participated");
        }else{
            $ep = $this->eventInterface->addEventParticipant($request->event_id,$request->user_id);
            if(! empty($ep)){
                return apiSuccessMessage("Successfully Participated");
            }else{
                return commonErrorMessage();
            }
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getParticipants($id){
        $eventParticipants = $this->eventInterface->getEventParticipants($id);
        return apiSuccessMessage("Participants List",$eventParticipants);
    }

    /**
     * @param AddEventParticipantRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getEventAndUserDetails(AddEventParticipantRequest $request){
        $event =  $this->eventInterface->find($request->event_id);
        $user =  $this->userInterface->find($request->user_id);
        if(! empty($event)){
            if(! empty($user)){
                $event->user->id = $user->id;
                $event->user->full_name = $user->full_name;
                $event->user->email = $user->email;
                return apiSuccessMessage("Data Found",$event);
            }else{
                return commonErrorMessage("User Not Found");
            }
        }else{
            return commonErrorMessage("Event Not Found");
        }
        return apiSuccessMessage("Event Details",$event);
    }

    /**
     * Return all event list for sales report search
     */
    public function getAllEventList(){
        $events = $this->eventInterface->getAllEventList();
        return apiSuccessMessage("Event List",$events);
    }

}
