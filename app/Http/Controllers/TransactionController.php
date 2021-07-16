<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$resp = Transaction::orderBy("id","DESC")->paginate(1);
        $resp = Transaction::orderBy("id","DESC")->get();
        return response()->json($resp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'amount' => 'required|numeric',
            'description' => 'required',
        ]);
        
        if ($validator->fails()) {
           
            return response()->json([
                'status' => 'error',
                'message'=>implode(" | ",$validator->messages()->all())
            ]);
        }

        $type = $request->input('type');
        $amount = $request->input('amount');
        
        $data = array();
        $data['date'] = date("Y-m-d");
        $data['description'] = $request->input('description');

        $resp = Transaction::get()->last();
        $runningBalance = $resp->runningBalance;

        if($type == "Debit"){
            
            if($runningBalance <1 || $runningBalance < $amount){
                return response()->json([
                    'status' => 'error',
                    'message'=>'Your balance is insufficient to process the transaction!!'
                ]);
            }
            $data['debit'] = $amount;
            $data['runningBalance'] = $runningBalance - $amount;
        }else{
            $data['credit'] = $amount;
            $data['runningBalance'] = $runningBalance + $amount;
        }
        //print_r($data);die;
        $resp = Transaction::create($data);
        return response()->json([
            'status' => 'success',
            'message'=>'Transaction Created Successfully!!',
            'transaction'=>$resp
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaction  $Transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $Transaction)
    {
        return response()->json($Transaction);
    }

    

}
