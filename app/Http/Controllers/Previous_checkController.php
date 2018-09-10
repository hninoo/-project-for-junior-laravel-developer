<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Check_status;
use App\Models\Check;
use App\Models\Account;
use App\Models\Status;
class Previous_checkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=session()->get("user_id");
      
        $data['users']=Check::with("check_status")->where("account_id",$user_id)->get()->toArray();

        $event=array();

        foreach ($data['users'] as $value) 
        {
                // dd($value);
            foreach ($value['check_status'] as $key) 
            {
                // dd($key);
                $status_id=$value['check_status'][0]['status_id'];
                // dd($status_id);
                 $status=Status::where('id',$status_id)->get()->toArray();
             // dd($status[0]['status_name']);
                $status_name=$status[0]['status_name'];
                // dd($status_name);
            }
             
              
            
          
            $result=array();
            $result['time']=$value['check_in_time'];
            $result['end']=$value['check_out_time'];
            $result['status']=$status_name;

            array_push($event, $result);
            
        }
            // dd($result);

            $res=json_encode($event);

            // dd($res);


        return view('users.previous_check', compact('res'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
