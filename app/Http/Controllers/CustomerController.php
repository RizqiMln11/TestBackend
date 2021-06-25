<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\message;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function sendMessageToCust(Request $request)
    {
        if (auth()->user()->user_type_id !== 1) {
            abort(404);
        }

        $request->validate([
            'to_id' => 'required'
          ]);

          $cust = User::find($request->to_id);
          if(!$cust || $cust->user_type_id == 2){
                return response()->json([
                    'status' => '500', 
                    'data' => 'Error! User yg anda chat tidak ada!'
                  ], 500);
          }

          $message = message::create([
              'from_id_users' => auth()->user()->id,
              'to_id_users' => $request->to_id,
              'message' => $request->message,
          ]);
        
          if(!$message){
            return response()->json([
                'status' => '500', 
                'data' => 'Error!'
              ], 500);
          }

        return response()->json([
            'status' => '200', 
            'data' => $message
          ], 200);
    }

    public function viewAllMessageIsRecived()
    {
        if (auth()->user()->user_type_id !== 1) {
            abort(404);
        }

          $message = Message::where('to_id_users', '=', auth()->user()->id)->get();
          if(!$message){
                return response()->json([
                    'status' => '200', 
                    'data' => 'chat di terima, kosong!'
                  ], 200);
          }

        return response()->json([
            'status' => '200', 
            'data' => $message
          ], 200);
    }

    public function viewAllMessageIsSent()
    {
        if (auth()->user()->user_type_id !== 1) {
            abort(404);
        }

          $message = Message::where('from_id_users', '=', auth()->user()->id)->get();
          if(!$message){
                return response()->json([
                    'status' => '200', 
                    'data' => 'chat terkirim, kosong!'
                  ], 200);
          }

        return response()->json([
            'status' => '200', 
            'data' => $message
          ], 200);
    }
}
