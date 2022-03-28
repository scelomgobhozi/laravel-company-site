<?php

namespace App\Http\Controllers;


use App\Models\category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;



class CategoryController extends Controller
{
    public function __construct(){
     $this->middleware('auth');    
    }
    public function AllCat(){
        $categories = category::latest()->paginate(3);
        $trashCat = category::onlyTrashed()->latest()->paginate(5);

        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index',compact('categories','trashCat'));
    }

    public function AddCat(Request $request){
        $validation = $request->validate([
            "category_name" => "required|unique:categories|max:225",

        ],
    [
        'category_name.required'=>'Please input Category Name',
        'category_name.max' => 'Category Less Then 255Chars' ,
    ]);

//   category::insert([
//       'category_name' => $request->category_name,
//       'user_id' => Auth::user()->id,
//       'created_at'=>Carbon::now()
//   ]);
        //Adding data
        $categories = new category;
        $categories->category_name = $request->category_name;
        $categories->user_id = Auth::user()->id;
        $categories->save();


    return Redirect()->back()->with('success','Category inserted Successfull');
    }



    public function Edit($id){
        $categories = category::find($id);
        return view('admin.category.edit',compact('categories'));

    }

    public function Update(Request $request , $id){

     $update = category::find($id)->update([
       'category_name'=>$request->category_name, 
       'user_id' => Auth::user()->id  
     ]);
    return Redirect()->route('all.category')->with('success','Category updated Successfull');
    }




    public function softDelete($id){

    $delete = category::find($id);  
    if($delete != null){
      $delete->delete();
      return Redirect()->back()->with('success','Category deleted successfully 👌🔥');
      }else{
        return Redirect()->back()->with('success','Failed to delete'); 
     }


    //   return redirect()->with('success','Category deleted successfully 👌🔥');
    }


    public function Restore($id){
     $restore = category::withTrashed()->find($id)->restore();
     if($restore != null){

       

        return Redirect()->back()->with('success','Category has been successfully restored👌🔥');

     } 
     else{
        return Redirect()->back()->with('failed','🔴🔴🔴 Something went wrong');
     }  

    }



    public function Pdelete($id){
    $pdelete = category::onlyTrashed()->find($id)->forceDelete();

    if($pdelete != null){

       

        return Redirect()->back()->with('success','RECORD HAS BEEN PERMANANTLY DELETED');

     } 
     else{
        return Redirect()->back()->with('failed','🔴🔴🔴');
     }  

    }
}
