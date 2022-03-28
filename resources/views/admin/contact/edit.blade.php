@extends('admin.admin_master')



@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Slider</h2>
            </div>
            <div class="card-body">
                <form action="{{url('contact/update/'.$contact->id)}}" method="post" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Email</label>
                        <input type="email" value="{{$contact->email}}" class="form-control" name="email" id="exampleFormControlInput1" placeholder="About title">
                        <span class="mt-2 d-block">We'll never share your email with anyone else.</span>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Address</label>
                        <input type="text" value="{{$contact->address}}" class="form-control" name="address" id="exampleFormControlInput1" placeholder="About title">

                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Phone Number</label>
                        <input type="text"  value="{{$contact->phone}}" class="form-control" name="phone" id="exampleFormControlInput1" placeholder="About title">

                    </div>



                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>

                    </div>
                </form>
            </div>
        </div>

    </div>


@endsection
