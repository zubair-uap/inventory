<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Validator;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    function index()
    {
        // $brand = Brand::find($id);
        $all_department = Department::all();
        return view('admin.department.index', compact('all_department'));
    }

    function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' =>  $validator->errors()->all()
            ]);
        }

        Department::create([
            'department_name' => $request->department_name,
        ]);

        return response()->json(['success' => 'Department created successfully.']);
    }



    function edit($id)
    {
        // dd($request);
        $brand = Department::find($id);
        return view('admin.brand.edit', compact('brand'));
    }

    function update(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'department_name' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ]);
        }

        Department::find($request->id)->update([
            'department_name' => $request->department_name,
        ]);

        return response()->json(['success' => 'Department Update successfully.']);
    }

    public function destroy($id)
    {
        // echo $user_id;
        Department::find($id)->delete();
        return response()->json(['success' => 'Delete sucessfull']);
    }
}
