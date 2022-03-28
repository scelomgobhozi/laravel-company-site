@extends('admin.admin_master')



@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Slider</h2>
            </div>
            <div class="card-body">

                <form action="{{ url('/slider/update/'.$content->id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Slider Title</label>
                        <input type="text" class="form-control" value="{{$content->title}}" name="title" id="exampleFormControlInput1" placeholder="Enter Slider Name">
                        <span class="mt-2 d-block">We'll never share your email with anyone else.</span>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">slider Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1"  name="description" rows="3">{{$content->description}}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlFile1">Slider Image</label>
                        <input type="file" class="form-control-file" value="{{$content->image}}" name="image" id="exampleFormControlFile1">
                    </div>
                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>

                    </div>
                </form>
            </div>
        </div>

    </div>


@endsection
