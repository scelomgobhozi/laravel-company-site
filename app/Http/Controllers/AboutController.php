<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeAbout;

class AboutController extends Controller
{
    public function HomeAbout(){
        $homeAbout = HomeAbout::latest()->get();
     return view('admin.home.index', compact('homeAbout'));
    }

    public function AddAbout(){
        return view('admin.home.create');
    }

    public function CreateAbout(Request $request)
    {

        $about = new HomeAbout;
        $about->title = $request->title;
        $about->short_dis = $request->short_dis;
        $about->long_dis = $request->long_dis;
        $about->save();


     return Redirect()->route('home.about')->with('success', 'About section inserted successfully');
    }

    public function EditAbout($id){
        $aboutData = HomeAbout::find($id);
        return view('admin.home.edit',compact('aboutData'));
    }

    public function UpdateAbout($id, Request $request){

       $about = HomeAbout::find($id);

       $about->title = $request->title;
       $about->short_dis = $request->short_dis;
       $about->long_dis = $request->long_dis;
       $about->save();

        return Redirect()->route('home.about')->with('success','About section Updated successfully');

    }

    public function DeleteAbout($id){
        HomeAbout::find($id)->delete();
        return Redirect()->route('home.about')->with('success','About deleted successfully');
    }
}
