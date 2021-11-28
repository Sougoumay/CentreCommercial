@extends('layouts.adminPrincipale')
@section('main')
    <!-- basic table start -->
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Basic Table</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Boutique</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <th>{{$user->id}}</th>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->boutique}}</td>
                                        <td>{{$user->amazons->status}}</td>
                                        <td ><a href="{{route('admin.showUserById',$user->id)}}" class="btn btn-primary">Show</a></td><td ><a href="{{route('admin.statuspost',$user->amazons->id)}}" class="btn btn-warning">Edit</a></td><td ><a href="{{route('admin.deleteUser',$user->id)}}" onclick="return confirm('Are you sure to delete this data?')" class="btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- basic table end -->
@endsection
