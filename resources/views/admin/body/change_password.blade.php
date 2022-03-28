
@extends('admin.admin_master')
@section('admin')

  <div class="card">
      <div class="card-harder card-header-border-bottom">
          <h2> Change Password </h2>
      </div>

      <div class="card-body">
    <div class="py-12">

        <div class="container">

    <form  method="POST" action="{{route('password.update')}}" class="form-pill">
      @csrf
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Current</label>
            <div class="col-sm-10">
                <input type="password" name="oldpassword" class="form-control" id="current_password" placeholder="Current password">
                @error('oldpassword')
                <span class="text-danger"> {{$message}} </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">New Password</label>
            <div class="col-sm-10">
                <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                @error('password')
                <span class="text-danger"> {{$message}} </span>
                @enderror
            </div>
        </div>


        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Confirm Password</label>
            <div class="col-sm-10">
                <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password">
                @error('password_confirmation')
                <span class="text-danger"> {{$message}} </span>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </div>
    </form>
            </div>
        </div>
      </div>
  </div>

@endsection
