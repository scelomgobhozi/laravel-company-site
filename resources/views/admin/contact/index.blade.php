@extends('admin.admin_master')



@section('admin')

    <div class="py-12">

        <div class="container">
            <div class="row">
                <h4></h4>

                <a href="{{ route('admin.add') }}"> <button class="btn btn-info">Add Contact</button> </a>
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
                                <th scope="col" width="10%">Email</th>
                                <th scope="col" width="15%">Phone</th>
                                <th scope="col" width="30%">Adress</th>
                                <th scope="col" width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <!-- @php($i=1) -->
                            @foreach($contacts as $contact)
                                <tr>
                                    <th scope="row">{{ $i++ }}</th>
                                    <td>{{$contact->email}}</td>
                                    <td>
                                        {{$contact->phone}}
                                    </td>
                                    <td> {{$contact->address}} </td>


                                    <td>
                                        <a href="{{ url('/contact/edit/'.$contact->id) }}" class="btn btn-info"> Edit </a>
                                        <a href="{{ url('/contact/delete/'.$contact->id) }}" onclick="return confirm('Are you sure to delete')" class="btn btn-danger"> Delete </a>
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
