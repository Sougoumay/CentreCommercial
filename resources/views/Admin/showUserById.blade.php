@extends('layouts.adminPrincipale')
@section('main')
<!-- Textual inputs start -->
<div class="col-12 mt-5">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title">List of Users</h4>
            <div class="form-group">
                <label for="example-email-input" class="col-form-label">ID</label>
                <input class="form-control" type="number" value="{{$users->id}}" name="id">
            </div>
            <div class="form-group">
                <label for="example-text-input" class="col-form-label">Name</label>
                <input class="form-control" type="text" value="{{$users->name}}" name="name" >
            </div>
            <div class="form-group">
                <label for="example-search-input" class="col-form-label">Email</label>
                <input class="form-control" type="text" value="{{$users->email}}" name="email">
            </div>
            <div class="form-group">
                <label for="example-url-input" class="col-form-label">Boutique</label>
                <input class="form-control" type="text" value="{{$users->boutique}}" name="boutique">
            </div>
            <div class="form-group">
                <label for="example-tel-input" class="col-form-label">Status</label>
                <input class="form-control" type="text" value="{{$users->status}}" name="status">
            </div>
        </div>
    </div>
</div>
<!-- Textual inputs end -->
@endsection
