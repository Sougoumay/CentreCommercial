@extends('layouts.adminPrincipale')
@section('main')
    <!-- Textual inputs start -->
    <div class="col-12 mt-5">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Added of Product</h4>
                <div class="form-group">
                    <label for="example-text-input" class="col-form-label">Name</label>
                    <input class="form-control" type="text" name="name" >
                </div>
                <div class="form-group">
                    <label for="example-url-input" class="col-form-label">Description</label>
                    <input class="form-control" type="text" name="description">
                </div>
                <div class="form-group">
                    <label for="example-tel-input" class="col-form-label">Status</label>
                    <input class="form-control" type="text" name="status">
                </div>
            </div>
        </div>
    </div>
    <!-- Textual inputs end -->
@endsection
