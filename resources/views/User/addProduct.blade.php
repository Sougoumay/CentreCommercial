@extends('layouts.adminPrincipale')
@section('main')
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('user.addProduct') }}"  enctype="multipart/form-data">
                    @csrf
                    <h4 class="header-title">Added of Product</h4>
                    <div class="alert alert-danger">
                        @if($errors->any())
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="example-text-input" class="col-form-label">Name</label>
                        <input class="form-control" type="text" name="name" value="{{old('name')}}" >
                    </div>
                    <div class="form-group">
                        <label for="example-url-input" class="col-form-label">Description</label>
                        <input class="form-control" type="text" name="description" value="{{old('description')}}">
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="image" value="{{old('image')}}">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                    <div class="submit-btn-area">
                        <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
@endsection
