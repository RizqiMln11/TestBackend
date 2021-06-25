<?php

namespace App\Http\Controllers;

use App\Models\report;
use App\Models\User;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function sendReportoCust(Request $request)
    {
        if (auth()->user()->user_type_id !== 1) {
            abort(404);
        }

        $request->validate([
            'to_staff_id' => 'required',
            'cust_defendant_id' => 'required',
            'casses' => 'required',
          ]);

          $cust = User::find($request->cust_defendant_id);
          if(!$cust){
                return response()->json([
                    'status' => '500', 
                    'data' => 'Error! Customer yg anda laporkan tidak ada!'
                  ], 500);
          }

          $report = report::create([
              'from_cust_id' => auth()->user()->id,
              'to_staff_id' => $request->to_staff_id,
              'cust_defendant_id' => $request->cust_defendant_id,
              'casses' => $request->casses,
          ]);
        
          if(!$report){
            return response()->json([
                'status' => '500', 
                'data' => 'Error!'
              ], 500);
          }

        return response()->json([
            'status' => '200', 
            'data' => $report
          ], 200);
    }
}
