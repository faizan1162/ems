<?php
/**
 * Created by PhpStorm.
 * User: BSQPTECH
 * Date: 1/27/2022
 * Time: 4:20 AM
 */

namespace App\Contracts;


interface DashboardInterface
{
    public function countTotalEvents();
    public function countCompletedEvents();
    public function countScheduledEvents();
    public function countTotalUsers();
    public function countTotalRevenues();
    public function countTodayRevenues();
    public function getYearlySales($year);
    public function salesReport($event_id,$ticket_type_id);
    public function salesReportEarningCount($event_id,$ticket_type_id);


}