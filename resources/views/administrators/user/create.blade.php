@extends('administrators.layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Users </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Users</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <form class="form-sample" method="POST" action="{{url('users/store')}}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name">
                                        @error('name')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="email">
                                        @error('email')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control @error('password') is-invalid @enderror" name="password">
                                        @error('password')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">User Type</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm @error('user_type') is-invalid @enderror" id="userType" name="user_type">
                                            <option value="">Select User Type</option>
                                            <option value="admin">Admin</option>
                                            <option value="instructor">Instructor</option>
                                        </select>
                                        @error('user_type')
                                        <div class="invalid-feedback">{{$message}}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Campus</label>
                                    <div class="col-sm-9">
                                        <select class="form-control form-control-sm @error('campus') is-invalid @enderror" id="campus" name="campus">
                                            <option value="">Select Campus</option>
                                            @foreach($campuses as $campus)
                                            <option value="{{$campus->campus_id}}">{{$campus->campus_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('campus')
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