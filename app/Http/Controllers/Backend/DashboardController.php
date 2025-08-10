<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Payments\Order;
use App\Models\User;

class DashboardController extends Controller
{
    
    public function dashboard(Request $request)
    {
        $data['header_title'] = "Dashboard";

        $data['totalOrder']   = Order::getTotalOrder();
        $data['totalTodayOrder']   = Order::getTotalTodayOrder();
        $data['totalAmount']   = Order::getTotalAmount();
        $data['totalTodayAmount']   = Order::getTotalTodayAmount();
        $data['totalCustomer']   = User::getTotalCustomer();
        $data['totalTodayCustomer']   = User::getTotalTodayCustomer();
        $data['latestOrders']   = Order::getLatestOrders();


        if (!empty($request->year))
        {
            $year = $request->year;

        }
        else
        {
            $year = date('Y');

        }



        $getTotalCustomerMonth = '';
        $getTotalOrderMonth = '';
        $getTotalAmountMonth = '';

        $totalAmount = 0;

        for ($month = 1; $month <= 12; $month++)
        { 
            $startDate = new \DateTime("$year-$month-01");
            $endDate = new \DateTime("$year-$month-01");
            $endDate->modify('last day of this month');

            $start_date = $startDate->format('Y-m-d');
            $end_date = $endDate->format('Y-m-d');

            //customer
            $customer   = User::getTotalCustomerMonth($start_date, $end_date);
            $getTotalCustomerMonth .= $customer. ','; 

            //order
            $order   = Order::getTotalOrderMonth($start_date, $end_date);
            $getTotalOrderMonth .= $order. ',';
            
            //order Amount
            $orderAmount   = Order::getTotalAmountMonth($start_date, $end_date);
            $getTotalAmountMonth .= $orderAmount. ',';
             
            //Total Amount
            $totalAmount = $totalAmount + $orderAmount; 


            // echo $start_date;
            // echo "<br>";
            // echo $end_date;
            // echo "<br>";
        }

        $data['getTotalCustomerMonth']   = rtrim($getTotalCustomerMonth, ",");
        $data['getTotalOrderMonth']      = rtrim($getTotalOrderMonth, ",");
        $data['getTotalAmountMonth']     = rtrim($getTotalAmountMonth, ",");
        $data['totalAmount']     = $totalAmount;
        $data['year']            = $year;

        return view('backend.dashboard',$data); 
    }
} 
