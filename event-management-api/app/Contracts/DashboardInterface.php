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


}