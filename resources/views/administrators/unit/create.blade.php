@extends('administrators.layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Units </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Units</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Default form</h4>
                    <p class="card-description"> Basic form layout </p> -->
                    <form class="col-md-4 forms-sample">
                        <div class="form-group">
                            <label for="exampleInputUsername1">Unit Name</label>
                            <input type="text" class="form-control" id="unit_name" placeholder="Unit Name">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection