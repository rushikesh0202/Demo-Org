<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Employee;
use App\Models\EmpDetails;
use App\Models\Department;
use Illuminate\Http\Request;
use Validator;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $token = $request->header('Authorization');
        if(empty($token))
        {
            return response()->json(['Error', 'Token Mismatch.'], 422);
        }
        else
        {
            $token_match_comp = Company::where('api_token', $token)->first();
            if($token_match_comp)
            {                                                        
                $employees = Employee::with('department.company', 'emp_details')->get();
                return response()->json([
                    "success" => true,
                    "message" => "Employee List",
                    "data" => $employees
                ]);
            }
            else{
                return response()->json(['Error', 'Token Mismatch.'], 422);       
            }
        }                                 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['Error', $validator->errors()], 400);
        }
        $token = $request->header('Authorization');
        if(empty($token))
        {
            return response()->json(['Error', 'Token Mismatch.'], 422);
        }
        else
        {
            $token_match_comp = Company::where('api_token', $token)->first();
            if($token_match_comp)
            {                                                                
                $employee = Employee::create([
                    'first_name' => $input['first_name'],
                    'last_name'  => $input['last_name']
                ]);
                $department = Department::where('name', $input['department'])->first();
                $employee->department()->associate($department);
                $employee->emp_details()->create([
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'mobile' => $input['mobile'],
                    'address' => $input['address'],
                ]);
                $employee->save();        
                return response()->json([
                    "success" => true,
                    "message" => "Employee created successfully.",
                    "data" => $employee
                ]);
            }
            else{
                return response()->json(['Error', 'Token Mismatch.'], 422);       
            }
        }                                 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $token = $request->header('Authorization');
        if(empty($token))
        {
            return response()->json(['Error', 'Token Mismatch.'], 422);
        }
        else
        {
            $token_match_comp = Company::where('api_token', $token)->first();
            if($token_match_comp)
            {                                                                
                $employee = Employee::with('department.company', 'emp_details')->find($id);
                if (is_null($employee)) {
                    return response()->json(['Error', 'Employee not found.'], 203);
                }
                return response()->json([
                    "success" => true,
                    "message" => "Employee retrieved successfully.",
                    "data" => $employee
                ]);
            }
            else{
                return response()->json(['Error', 'Token Mismatch.'], 422);       
            }
        }                                                 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'first_name' => 'required',
            'last_name' => 'required',
            'department' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['Error', $validator->errors()], 400);
        }
        $token = $request->header('Authorization');
        if(empty($token))
        {
            return response()->json(['Error', 'Token Mismatch.'], 422);
        }
        else
        {
            $token_match_comp = Company::where('api_token', $token)->first();
            if($token_match_comp)
            {   
                $emp_details = new EmpDetails([
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'mobile' => $input['mobile'],
                    'address' => $input['address']                
                ]);                                                                     
                $employee->first_name = $input['first_name'];
                $employee->last_name = $input['last_name'];
                $department = Department::where('name', $input['department'])->first();
                $employee->department()->associate($department);
                // $employee->emp_details->email = $input['email'];
                // $employee->emp_details->phone = $input['phone'];
                // $employee->emp_details->mobile = $input['mobile'];
                // $employee->emp_details->address = $input['address'];
                // $employee->push();
                           
                $employee->emp_details()->update([
                    'email' => $input['email'],
                    'phone' => $input['phone'],
                    'mobile' => $input['mobile'],
                    'address' => $input['address']                
                ]);            
                $employee->save(); 

                return response()->json([
                    "success" => true,
                    "message" => "Employee updated successfully.",
                    "data" => $employee
                ]);
            }
            else{
                return response()->json(['Error', 'Token Mismatch.'], 422);       
            }
        }                                                                 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, Request $request)
    {
        $token = $request->header('Authorization');
        if(empty($token))
        {
            return response()->json(['Error', 'Token Mismatch.'], 422);
        }
        else
        {
            $token_match_comp = Company::where('api_token', $token)->first();
            if($token_match_comp)
            {                                                                                
                $employee->delete();
                return response()->json([
                    "success" => true,
                    "message" => "Employee deleted successfully.",
                    "data" => $employee
                ]);
            }
            else{
                return response()->json(['Error', 'Token Mismatch.'], 422);       
            }
        }                                                                                 
    }
}