<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;

class CompanyController extends Controller
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
                $companies = Company::all();
                return response()->json([
                    "success" => true,
                    "message" => "Company List",
                    "data" => $companies
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
            'industry' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'fax' => 'required'
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
                $input['api_token'] = Str::random(30);
                $company = Company::create($input);
                return response()->json([
                    "success" => true,
                    "message" => "Company created successfully.",
                    "data" => $company
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
        $company = Company::find($id);
        if (is_null($company)) {
            return response()->json(['Error', 'Company not found.'], 203);           
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
                    "message" => "Company retrieved successfully.",
                    "data" => $company
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
    public function update(Request $request, Company $company)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'industry' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'mobile' => 'required',
            'fax' => 'required'
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
                $company->name = $input['name'];
                $company->industry = $input['industry'];
                $company->address = $input['address'];
                $company->phone = $input['phone'];
                $company->mobile = $input['mobile'];
                $company->fax = $input['fax'];
                $company->save();
                return response()->json([
                    "success" => true,
                    "message" => "Company updated successfully.",
                    "data" => $company
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
    public function destroy(Company $company, Request $request)
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
                $company->delete();
                return response()->json([
                    "success" => true,
                    "message" => "Company deleted successfully.",
                    "data" => $company
                ]);
            }
            else{
                return response()->json(['Error', 'Token Mismatch.'], 422);       
            }
        }                                                    
    }
}
