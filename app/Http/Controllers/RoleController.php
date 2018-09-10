<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Account;
use App\Models\Timeplan;

use Validator;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles']=Role::with("account")->get()->toArray();
        // dd($data);
        return view('roles.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('roles.list');
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
            'role_name' => 'required|regex:/^[a-zA-Z ]+$/|unique:roles|max:255|min:3',
            
        ]);

           if ($validator->fails()) 
           {
            return redirect('role')
                        ->withErrors($validator)
                        ->withInput();
           }
           else
           {
            $role=new Role();
            $role->role_name=$request->input('role_name');
            // dd($role);
            $role->save();
            return redirect('role');
           }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function block_user()
    {
        // $data['users']=Account::join("account_roles","account_roles.account_id","=","account.id")->join("roles","roles.id","=","account_roles.role.id")
        $data['users']=Account::with('role')->where('active',0)->get()->toArray();
        $data['time_plans']=Timeplan::get()->toArray();
        // dd($data);
        return view("users.unactive_list",$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reactive($id)
    {
        // dd($id);
        $data=Account::where('id',$id)->first();
        // dd($data);
        $data->active=1;
        $data->save();
        return redirect('unactive_user');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // dd($id);
        $data['roles']=Role::where('id',$id)->first()->toArray();
        // dd($data);
        return view('roles.edit',$data);
    }
    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            
            "role_name"=>'required',
            ]);
        if($validator->fails())
        {
            // echo "fail";die();
            return redirect('role/edit/'.$id)->withErrors($validator)->withInput();
        }
        else
        {
            $role=Role::where('id',$id)->first();
            $role->role_name=$request->input('role_name');
            // dd($role);
            $role->save();
            return redirect("role");
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data=Account::where('id',$id)->first();
        // dd($data);
        $data->active=2;
        $data->save();
        return redirect('unassigned_user');
    }
}
