<?php

namespace App\Http\Controllers;

use App\Models\category;
use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class HomeController extends Controller
{
    public function HomeSlider()
    {
        $sliders = Slider::latest()->get();
        return view('admin.slider.index', compact('sliders'));
    }

    public function AddSlider()
    {
        return View('admin.slider.create');
    }

    public function StoreSlider(Request $request)
    {
//        $validateData = $request->validate([
//            'title'=> 'required|unique:brands|max:255',
//            'image'=> 'required|mimes:jpg,jpeg,png',
//
//        ],
//            [
//                'title.required'=>'Please input Category Name',
//                'image.min'=>'Brand is not the appropriate file type',
//            ]);


        $image = $request->file('image');
        // $name_gen = hexdec(uniqid());
        // $image_ext = strtolower($brand_image->getClientOriginalExtension());
        // $image_name = $name_gen.'.'.$image_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$image_name;
        // $brand_image->move($up_location,$image_name);
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(1920, 1088)->save('image/slider/' . $name_gen);
        $last_img = 'image/slider/' . $name_gen;
        Slider::insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('home.slider')->with('success', 'Slider inserted successfully');
    }

    public function EditSlider($id)
    {
        $content = Slider::find($id);
        return view('admin.slider.edit', compact('content'));
    }


    public function UpdateSlider($id, Request $request)
    {
        $update = category::find($id)->update([
            'title'=>$request->title,
            'description'=>$request->description,

        ]);


        $image = $request->file('image');
        // $name_gen = hexdec(uniqid());
        // $image_ext = strtolower($brand_image->getClientOriginalExtension());
        // $image_name = $name_gen.'.'.$image_ext;
        // $up_location = 'image/brand/';
        // $last_img = $up_location.$image_name;
        // $brand_image->move($up_location,$image_name);
        if ($image) {
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(1920, 1088)->save('image/slider/' . $name_gen);
            $last_img = 'image/slider/' . $name_gen;
            Slider::find($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $last_img,
                'updated_at' => Carbon::now()
            ]);
        } else {
            Slider::find($id)->update([
                'title'=>$request->title,
                'description'=>$request->description,


                'updated_at' => Carbon::now()

            ]);
        }
        return Redirect()->route('home.slider')->with('success', 'Slider updated successfully');
    }

    public function DeleteSlider($id){
        slider::find($id)->delete();
        return Redirect()->route('home.slider')->with('success', 'Slider deleted successfully');

    }
}
