@extends('administrators.layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Campus </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Campus</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form class="form-sample" method="POST" action="{{url('campuses/store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Campus Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('campus_name') is-invalid @enderror" name="campus_name">
                                        @error('campus_name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Latitude</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude">
                                        @error('latitude')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Longitude</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude">
                                        @error('longitude')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-gradient-primary me-2">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection