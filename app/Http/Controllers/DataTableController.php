<?php

namespace App\Http\Controllers;

use App\DataTable;
use Illuminate\Http\Request;

class DataTableController extends Controller
{

    public function store(Request $request)
    {
//        dd($request->all());
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:data_tables',
            'username'=>'required|unique:data_tables',
            'password'=>'required|min:3|confirmed'
        ]);
        $res = DataTable::create($request->all());
        if($res)
            return redirect()->back()->with(['message'=>'Successfully Done']);
        return redirect()->back()->with(['message'=>'Failed']);
    }

    public function isEmail(Request $request){
      $a =  DataTable::where('email','=',$request->email)->get();
       if($a->count()==0)
           return "true";
       return "false";
    }


}
