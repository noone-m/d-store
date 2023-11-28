<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Medicine;
use Exception;

use function PHPSTORM_META\type;

class WarehouseOwnerController extends Controller
{


    public function getAllCategories(){
         $categories=Category::all();
        return $categories;
    }
    public function getMedicines($id){
        $category=Category::find($id);
        return $category->medicines ;
    }

      public function addCategory(Request $request){
        Category::create([
            "name"=> $request->name,
          ]);

          return response()->json(["Message"=>"added successfully ",200]);

    }

    public function addMedicine(Request $request){


        try{
      $request->validate([
        "scientific_name"=> "required",
        "commercial_name"=> "required",
        "category_id"=> "required",
        "manufacture_company"=> "required",
        "quantity"=> "required",
        "expiration_date"=> "required",
        "price"=> "required",
      ]);
    }catch (Exception $e) {
        return response()->json($e->getMessage());
    }
      Medicine::create([
        "scientific_name"=> $request->scientific_name,
        "commercial_name"=> $request->commercial_name,
        "category_id"=> $request->category_id,
        "manufacture_company"=> $request->manufacture_company,
        "quantity"=> $request->quantity,
        "expiration_date"=> $request->expiration_date,
        "price"=> $request->price,
      ]);

      return response()->json(["Message"=>"added successfully ",200]);

    }

}
