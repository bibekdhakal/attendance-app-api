@extends('administrators.layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Units </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Units</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <form class="col-md-4 forms-sample" method="POST" action="{{url('units/update', $unit->unit_id)}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Unit Name</label>
                            <input type="text" class="form-control @error('unit_name') is-invalid @enderror" name="unit_name" id="unit_name" value="{{$unit->unit_name}}">
                            @error('unit_name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection