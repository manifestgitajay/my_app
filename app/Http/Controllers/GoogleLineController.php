<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

Use DB;
 
use App\Models\User;
 
use Carbon\Carbon;

class GoogleLineController extends Controller
{
    public function index()
    {
 
     $data['lineChart'] = User::select(\DB::raw("COUNT(*) as count"), \DB::raw("MONTHNAME(created_at) as month_name"),\DB::raw('max(created_at) as createdAt'))
        ->whereYear('created_at', date('Y'))
        ->groupBy('month_name')
        ->orderBy('createdAt')
        ->get();
 
        return view('google-line-chart', $data);
    }


    public function line_chart(){

       

      $data['lineChart'] =DB::table('trip')
        ->selectRaw('sum(booking_cost) as sums')
        ->selectRaw('MONTHNAME(trip_date) as month_name')
        // ->selectRaw("DATE_FORMAT(trip_date,'%M %Y') as months")
        ->groupBy('month_name')
        ->get();


        return view('google-line-chart', $data);
    }

    public function get_data_by_date(Request $request)
    {
       
       $trip=$request->date;
       
   if($trip){
    
       $data['lineChart'] =DB::table('trip')
       ->selectRaw('sum(booking_cost) as sums')
       ->selectRaw('MONTHNAME(trip_date) as month_name')      
       ->where('trip_date',$trip)
       ->orwhere('booking_date',$trip) 
       ->groupBy('month_name')     
       ->get();
       return response()->json(['res'=>$data]);
    }
}

   public function donut_chart(Type $var = null)
   {
    
    $students = DB::table('trip')
    ->select('trip_status', \DB::raw("COUNT('id') as count"))
    ->groupBy('trip_status')
    ->get();  
    
     return view('donutChart', compact('students'));   

   }

   public function get_date_dount(Request $request)
   {  
       $status=$request->status;      
       $from=$request->from;
       $to=$request->to;

    //    $month= date('m',strtotime('2021-06-05'));
       if($status=="month"){
        $month= date('m',strtotime($from));   
       $students = DB::table('trip')
       ->select('trip_status', \DB::raw("COUNT('id') as count"))
       ->whereMonth('trip_date', '=', $month)
       ->groupBy('trip_status')
       ->get();
       return response()->json(['res'=>$students]);
       }

       if($status=="year"){
        $year= date('Y',strtotime($from));   
         $students = DB::table('trip')
       ->select('trip_status', \DB::raw("COUNT('id') as count"))
       ->whereYear('trip_date', '=', $year)
       ->groupBy('trip_status')
       ->get();
       return response()->json(['res'=>$students]);
       }

       if($status=="week"){
     
       $students = DB::table('trip')
       ->select('trip_status', \DB::raw("COUNT('id') as count"))
       ->whereBetween('trip_date', [$from, $to])
       ->groupBy('trip_status')
       ->get();
       return response()->json(['res'=>$students]);
       }

   }
}
