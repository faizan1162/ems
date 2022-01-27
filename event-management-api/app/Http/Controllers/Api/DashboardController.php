<?php

namespace App\Http\Controllers\Api;

use App\Contracts\DashboardInterface;
use App\Http\Controllers\Controller;

/**
 * Class DashboardController
 * @package App\Http\Controllers\Api
 */
class DashboardController extends Controller
{
    /**
     * @var DashboardInterface
     */
    private $dashboardInterface;

    /**
     * DashboardController constructor.
     * @param DashboardInterface $dashboardInterface
     */
    public function __construct(DashboardInterface $dashboardInterface)
    {
        $this->dashboardInterface = $dashboardInterface;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(){
        $data['totalEvents'] = $this->dashboardInterface->countTotalEvents();
        $data['completedEvents'] = $this->dashboardInterface->countCompletedEvents();
        $data['scheduledEvents'] = $this->dashboardInterface->countScheduledEvents();
        $data['total_users'] = $this->dashboardInterface->countTotalUsers();
        $data['totalRevenue'] = $this->dashboardInterface->countTotalRevenues();
        $data['todayRevenue'] = $this->dashboardInterface->countTodayRevenues();
        $tSales = $this->dashboardInterface->getYearlySales(2022);
        $data['currentRevenue'] = $tSales['admin_earnings'];
        $data['sumRevenue'] = $tSales['sum_earnings'];
        return apiSuccessMessage("Dashboard Data",$data);
    }
}
