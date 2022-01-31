<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function AllCat(){
        return view('admin.category.index');
    }

    public function AddCat(Request $request){
        $validation = $request->validate([
            'category_name' => 'required | unique:category | max:225',
            'body'=>'required',
        ],
    [
        'category_name.required'=>'Please input Category Name',
        'category_name.max' => 'Category Less Then 255Chars' ,
    ]);
    category:: insert([
        'category_name' => $request->category_name,
        'user_id' => Auth::user()->id,
        'created_at'=>Carbon::now()
    ]);


    }
}
