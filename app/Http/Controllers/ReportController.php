<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Account_role;
use App\Models\Timeplan;
use App\Models\Day;
use App\Models\Check;
use App\Models\Status;
use App\Models\Role;
// use App\Models\Late;
use App\Models\Check_status;
// use App\Models\Leave_absent;
use DateTime;
use DateTimeZone;
use DateInterval;
use DatePeriod;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_manhour = array();
        $datas = array();
        $a_user=$this->get_activeuser();
       
        foreach ($a_user as $key) 
        {
          $check = $this->get_check($key['id']);
          // dd($check);
          $uncheck[] = $this->get_uncheck($key['id']);
            // dd($uncheck);
          if(is_array($uncheck) || is_object($uncheck))
                {
                    foreach ($uncheck as $value)
                    {
                        $_check = $this->leave_off_spilt($key['id'],$value);
                    }
                    // dd($_check);die();
                  
                }

            $check = $this->custom_arr($check);
            // dd($check);die();
                $_check = $this->custom_arr($_check);
                // dd($_check);
                foreach ($_check as $all_key => $all_data)
                {
                  $check [$all_key] = $all_data;
                }
                // dd($check);
                $datas[$key['account_id']] = $check;    
               // dd($datas[$key['account_id']] = $check);die();

        }
        $data['user'] = $a_user;
        $data['monthly_data'] = $datas;
       // dd($data);
       // dd($data['monthly_data']);die();

        return view('reports.report',$data);

    }


    function get_activeuser()
    {
         $role=Role::where('role_name',"Admin")->first();
        // dd($role);
        $data=Account::join("account_roles","account_roles.account_id","=","accounts.id")->where('active','!=',0)->where('account_roles.role_id','!=',$role['id'])->get()->toArray();

        return $data;
    }

    function get_check($id)
      {
        // dd($id);
        $ress=Check::join("accounts","accounts.id","=","checks.account_id")->join("account_roles","account_roles.account_id","=","accounts.id")->join("check_statuses","checks.id","=","check_statuses.check_id")->join("statuses","statuses.id","=","check_statuses.status_id")->select("checks.date","checks.manhour","checks.account_id","checks.check_in_time","checks.check_out_time","statuses.status_name")->where("account_roles.account_id",$id)->get()->toArray();
        // dd($ress);
        return $ress;
      }

    function get_uncheck($id)
      {
        $spilt_res = array();
        $currDate = $this->get_to_current_day();
        $query = $this->get_check_timeplan($id);
        // dd($query);
        $check_date = array();
        foreach($query as $_date)
        {
          $check_date[]=$_date['date'];
        }
        // dd($check_date);die();
        $date_diff=array_diff($currDate,$check_date);
        // dd($date_diff);
        if($date_diff!=null)
        {
            foreach ($date_diff as $row)
            {
              $diff_res[]=$row;
            }//end
            
        }
        else
        {
          $diff_res=array();
        }
        // dd($diff_res);
    return $diff_res;

    }


    protected function custom_arr($_arr){
        $return_arr  = array( );
        for($i=0; $i < sizeof($_arr) ; $i++){
             $return_arr[$_arr[$i]['date']]  = $_arr[$i];
        }
        // dd($return_arr);
        return $return_arr;

    }

      function get_to_current_day()
      {
        $start = new DateTime('first day of this month');
        $end = new DateTime(date("Y-m-d"));
        $end = $end->modify("+1 day");
        $interval = new DateInterval('P1D');
        $datarange = new DatePeriod($start,$interval,$end);
        foreach ($datarange as $data)
        {
          $date[] = $data->format("Y-m-d");
        }
        // dd($date);
        return $date;
      }
      function get_check_timeplan($id)
      {
        $currDate=$this->get_to_current_day();
        // dd($currDate);die();
        $timeplan['tdata']=Account::join("account_roles","account_roles.account_id","=","accounts.id")->join("checks","checks.account_id","=","account_roles.account_id")->select("checks.date","checks.time_plan_id")->where("checks.date",$currDate)->where("account_roles.account_id",$id)->get()->toArray();
        // dd($timeplan['tdata']);
        return  $timeplan['tdata'];

      }

    function leave_off_spilt($id,$date_data)
      {
        $absent = array();
        $off = array();
        $count = sizeof($date_data);
        $thist = $this->get_timeplanhist($id);
            foreach($thist as $d)
            {
              // $tdate[]=$d['date'];
              $tname[] = $d['time_plan_id'];
            }

        for($i=0;$i<$count;$i++)
            {
              $dt=strtotime($date_data[$i]);
              $day=date("D",$dt);

              if($this->check_day($day,$tname[0])){
                $absent[] = $i;
              }else{
                $off[] = $i;
              }
            }
         $ur = $this->get_user_role_id($id);

        
         foreach ($off as $key)
            {
              $dt=strtotime($date_data[$key]);
              $day=date("D",$dt);
              $offdate[]  = $date_data[$key];

              foreach($offdate as $indi_date)
              {
                $spilt_res[] = array("date"=>$indi_date,"manhour"=>'0',"status_name"=>"off");
              }
            }
            foreach ($absent as $key )
            {
              $dt=strtotime($date_data[$key]);
              $day=date("D",$dt);
              $date[]  = $date_data[$key];
            }
            if(isset($date))
            {
                foreach ($date as $status_date)
                {
                    
                      // if(!$this->check_has_leave($id,$status_date))
                      // {
                        $spilt_res[] = array("date" => $status_date,'manhour'=>'0','status_name'=>'absent','user_role_id'=>$ur['id']);
                      // }
                      // else
                      // {
                      //   $spilt_res[] = array("date"=>$status_date,'manhour'=>'0','status'=>'leave','user_role_id'=>$ur['id']);
                      // }
                  
                }
            }
            else
            {
              $spilt_res[] = array("date" => " ",'manhour'=>'0','status'=>' No Data ','user_role_id'=> $ur['id']);
            }

          

            return $spilt_res;

      }


   
  function check_day($day,$id)
  {
    $chk_day=Day::join("time_plans","time_plans.id","=","days.time_plan_id")->select("days.day_name")->where("days.time_plan_id",$id)->where("days.day_name",$day)->get()->toArray();
    
    return $chk_day;
  }


    function get_user_role_id($id)
    {
        $user_role=Account_role::select('id')->where('account_roles.account_id',$id)->first();
        return $user_role;
    }
    function get_timeplanhist($id)
        {
            $timehis=Timeplan::join("account_roles","account_roles.time_plan_id","=","time_plans.id")->select("account_roles.time_plan_id")->where("account_roles.account_id",$id)->get()->toArray();

            return $timehis;
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
