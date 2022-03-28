@extends('admin.admin_master')



@section('admin')

    <div class="py-12">

        <div class="container">
            <div class="row">
                <h4></h4>

                <a href="{{ route('add.about') }}"> <button class="btn btn-info">Add About</button> </a>
                <br> <br>
                <div class="col-md-12">
                    <div class="card">
                        @if(session('failed'))
                            <div class="alert alert-danger" role="alert">
                                {{session('failed')}}
                            </div>

                        @endif

                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                        @endif
                        <div class="card-header"> About Section</div>



                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col" width="5%">SL No</th>
                                <th scope="col" width="10%">Home Title</th>
                                <th scope="col" width="15%">Short Description</th>
                                <th scope="col" width="30%">Long Description</th>
                                <th scope="col" width="15%">Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- @php($i=1) -->
                            @foreach($homeAbout as $about)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{$about->title}}</td>
                                    <td>
                                        {{$about->short_dis}}
                                    </td>
                                    <td> {{$about->long_dis}} </td>


                                    <td>
                                        <a href="{{ url('/about/edit/'.$about->id) }}" class="btn btn-info"> Edit </a>
                                        <a href="{{ url('/about/delete/'.$about->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger"> Delete </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        {{--                        {{$sliders->links()}}--}}

                    </div>
                </div>
                {{--               ------Was here--}}

            </div>
        </div>




    </div>
@endsection
