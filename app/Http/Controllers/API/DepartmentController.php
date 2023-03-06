<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Department;
use Illuminate\Http\Request;
use Validator;

class DepartmentController extends Controller
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
                $departments = Department::with('company')->get();
                return response()->json([
                    "success" => true,
                    "message" => "Department List",
                    "data" => $departments
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
            'name' => 'required',
            'company' => 'required'
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
                $department = Department::create($input);
                $company = Company::where('name', $input['company'])->first();
                $department->company()->associate($company);
                $department->save();        
                return response()->json([
                    "success" => true,
                    "message" => "Department created successfully.",
                    "data" => $department
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
        $departments = Department::with('company')->find($id);
        if (is_null($departments)) {
            return response()->json(['Error', 'Department not found.'], 203);
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
                return response()->json([
                    "success" => true,
                    "message" => "Department retrieved successfully.",
                    "data" => $departments
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
    public function update(Request $request, Department $department)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'company' => 'required'
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
                $department->name = $input['name'];
                $company = Company::where('name', $input['company'])->first();
                $department->company()->associate($company);
                $department->save();            

                return response()->json([
                    "success" => true,
                    "message" => "Department updated successfully.",
                    "data" => $department
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
    public function destroy(Request $request, Department $department)
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
                $department->delete();
                return response()->json([
                    "success" => true,
                    "message" => "Department deleted successfully.",
                    "data" => $department
                ]);
            }
            else{
                return response()->json(['Error', 'Token Mismatch.'], 422);       
            }            
        }                                                                    
    }
}