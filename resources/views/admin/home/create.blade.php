@extends('admin.admin_master')



@section('admin')
    <div class="col-lg-12">
        <div class="card card-default">
            <div class="card-header card-header-border-bottom">
                <h2>Create Slider</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('create.about')}}" method="post" >
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlInput1">Slider Title</label>
                        <input type="text" class="form-control" name="title" id="exampleFormControlInput1" placeholder="About title">
                        <span class="mt-2 d-block">We'll never share your email with anyone else.</span>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Short Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="short_dis" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Long Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" name="long_dis" rows="4"></textarea>
                    </div>

                    <div class="form-footer pt-4 pt-5 mt-4 border-top">
                        <button type="submit" class="btn btn-primary btn-default">Submit</button>

                    </div>
                </form>
            </div>
        </div>

    </div>


@endsection
