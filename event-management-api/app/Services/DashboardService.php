<?php
namespace App\Services;
use App\Contracts\DashboardInterface;
use App\Models\Event;
use App\Models\EventTicketBooking;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardService implements DashboardInterface
{
    public function countTotalEvents()
    {
        // TODO: Implement countTotalEvents() method.
        return Event::all()->count();
    }

    public function countCompletedEvents()
    {
        // TODO: Implement countCompletedEvents() method.
        return Event::whereDate('event_end_date','<',date('Y-m-d'))->get()->count();
    }

    public function countScheduledEvents()
    {
        // TODO: Implement countScheduledEvents() method.
        return Event::whereDate('event_start_date','>',date('Y-m-d'))->get()->count();
    }

    public function countTotalUsers()
    {
        // TODO: Implement countTotalUsers() method.
        return User::where("utype", 'user')->count();
    }

    public function countTotalRevenues()
    {
        // TODO: Implement countTotalRevenues() method.
        return EventTicketBooking::sum('total_price');
    }

    public function countTodayRevenues()
    {
        // TODO: Implement countTodayRevenues() method.
        return EventTicketBooking::whereDate('created_at',date("Y-m-d"))->sum('total_price');
    }

    public function getYearlySales($year = 2022)
    {
        // TODO: Implement getYearlySales() method.
        $admin_earnings = ["0"=>0,"1"=>0,"2"=>0,"3"=>0,"4"=>0,"5"=>0,"6"=>0,"7"=>0,"8"=>0,"9"=>0,"10"=>0,"11"=>0,"12"=>0];
        $sql = "SELECT SUM(`total_price`) AS `total_earnings`, MONTH(created_at) AS `sales_month` FROM event_ticket_bookings WHERE YEAR(`created_at`) = '{$year}' GROUP BY sales_month ASC";
        $yearData = DB::select($sql);
        $total_sales_earnings = 0;
        foreach($yearData as $data){
            $total_sales_earnings += $data->total_earnings;
            $admin_earnings[$data->sales_month - 1] = number_format($data->total_earnings,2,'.','');
        }
        $arr['sum_earnings'] = $total_sales_earnings;
        $arr['admin_earnings'] =  $admin_earnings;
        return $arr;
    }


}