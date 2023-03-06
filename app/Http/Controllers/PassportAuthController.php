<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
 use Illuminate\Support\Str;
use App\Models\Company;
class PassportAuthController extends Controller
{
    /**
     * Registration
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);
        $token = Str::random(30);    
        $company = Company::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'api_token' => $token 
        ]);
        
        return response()->json(['token' => $token], 200);
    }
}