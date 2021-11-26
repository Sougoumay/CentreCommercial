@extends('layouts.adminPrincipale')
@section('main')
    <!-- basic table start -->
    <div class="col-lg-6 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Basic Table</h4>
                <div class="single-table">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Boutique</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                        <tr>
                                            <th>{{$product->id}}</th>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->id}}</td>
                                            <td>{{$product->id}}</td>
                                            <td ><a href="{{route('deleteProduct',$product->id)}}" onclick="return confirm('Are you sure to delete this data?')" class="btn btn-danger">Delete</a></td>
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
