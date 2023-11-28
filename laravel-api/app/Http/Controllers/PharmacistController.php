<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Pharmacist;
use App\Models\Category;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Hash;

class PharmacistController extends Controller
{
    public function register(Request $request){
        $phone=Pharmacist::where('phone_number', $request->phone_number)->value("phone_number");
        if($phone)  return response()->json(["Message"=>" user already exist "],250);
        Pharmacist::create([
           "name"=>$request->name,
           "phone_number"=>$request->phone_number,
           "password"=> Hash::make($request->password),
        ]);
        return response()->json(["Message"=>"added successfully "],200);
    }


        public function login(Request $request)
       {
            
           try {
                 $user = Pharmacist::where('phone_number', $request->phone_number)->first();
                 if ($user && Hash::check($request->password, $user['password'])) {
                   $token = $user->createToken("api")->plainTextToken;
                   return response()->json([ 'data' => $token ] , 200 );
               } else {
                   return response()->json(['data' => 'wrong number or password'], 250);
               }
           } catch (Exception $e) {
               return response()->json([$e->getMessage()],250);
           }

       }
       public function logout()
       {
           DB::table('personal_access_tokens')->where('tokenable_id', Auth::id())->delete();
           return response()->json(['message' => 'Logged out successfully'], 200);
       }
       public function test($name)
       {
           Category::create([
            "name" => "$name"
           ]);
           DB::insert("INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES (NULL, 'solo', NULL, NULL)");
       }
}
