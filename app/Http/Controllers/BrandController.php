<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Multipic;
use Illuminate\Support\Carbon;
use  Image;
use \Illuminate\Support\Facades\Auth;


class BrandController extends Controller
{

    public function __construct(){
        $this->middleware('auth');    
       }
    public function AllBrand(){
        $brands = Brand::latest()->paginate(5);
        return view('admin.brand.index', compact('brands'));
    }

    public function StoreBrand(Request $request){
     $validateData = $request->validate([
      'brand_name'=> 'required|unique:brands|max:255',
      'brand_image'=> 'required|mimes:jpg,jpeg,png',

     ],
    [
    'brand_name.required'=>'Please input Category Name',
    'brand_image.min'=>'Brand is not the appropriate file type',
    ]);   
    

    $image = $request->file('brand_image');
    // $name_gen = hexdec(uniqid());
    // $image_ext = strtolower($brand_image->getClientOriginalExtension());
    // $image_name = $name_gen.'.'.$image_ext;
    // $up_location = 'image/brand/';
    // $last_img = $up_location.$image_name;
    // $brand_image->move($up_location,$image_name);
    $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    Image::make($image)->resize(300,200)->save('image/brand/'.$name_gen);
    $last_img = 'image/brand/'.$name_gen;
    Brand::insert([
        'brand_name'=>$request->brand_name,
        'brand_image'=> $last_img,
        'created_at'=>Carbon::now()
    ]);

    return Redirect()->back()->with('success','Brand inserted Successfully');
    }



    public function Edit($id){
        $brands = Brand::find($id);
        return view('admin.brand.edit',compact('brands'));
    }


    public function Update(Request $request ,  $id){
        $validateData = $request->validate([
            'brand_name'=> 'required|max:255',
           
      
           ],
          [
          'brand_name.required'=>'Please input Category Name',
          'brand_image.min'=>'Brand is not the appropriate file type',
          ]);   
          $old_image = $request->old_image;

          
          $brand_image = $request->file('brand_image');
        if($brand_image){
          $name_gen = hexdec(uniqid());
          $image_ext = strtolower($brand_image->getClientOriginalExtension());
          $image_name = $name_gen.'.'.$image_ext;
          $up_location = 'image/brand/';
          $last_img = $up_location.$image_name;
          $brand_image->move($up_location,$image_name);
          unlink($old_image);
          Brand::find($id)->update([
              'brand_name'=>$request->brand_name,
              'brand_image'=> $last_img,
              'created_at'=>Carbon::now()
          ]);
      
          return Redirect()->back()->with('success','Brand updated Successfully');  

        }else{
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
               
                'created_at'=>Carbon::now()

            ]);
            return Redirect()->back()->with('success','Brand updated Successfully');  
        }

          
   }

   public function Delete($id){
       $image = Brand::find($id);
       $old_image = $image->brand_image;
       unlink($old_image);


    Brand::find($id)->delete();   
    return Redirect()->back()->with('success','Brand deleted Successfully');  
   }

   public function Multipic (){
       $images = Multipic::all();
       return view('admin.multipics.index',compact('images'));
   }

   public function Storemultipic(Request $request){



   $image = $request->file('image');
   foreach((array) $image as $multi_img){
    
    $name_gen = hexdec(uniqid()).'.'.$multi_img->getClientOriginalExtension();
    Image::make($multi_img)->resize(300,300)->save('image/multi/'.$name_gen);
    $last_img = 'image/multi/'.$name_gen;
    Multipic::insert([
        
        'image'=> $last_img,
        'created_at'=>Carbon::now()
    ]);
}
    return Redirect()->back()->with('success','Brand inserted Successfully');
   }
 

   public function Logout(){
       Auth::logout();
       return Redirect()->route('login')->with('success', 'User Logout');
   }

}
