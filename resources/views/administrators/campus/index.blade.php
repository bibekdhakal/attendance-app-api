@extends('administrators.layouts.layout')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Campuses</h4>
            <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
            </p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Campus Name</th>
                        <th>Latitude</th>
                        <th>Longitude</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campuses as $campus)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$campus->campus_name}}</td>
                        <td>{{$campus->latitude}}</td>
                        <td>{{$campus->longitude}}</td>
                        <td><button type="button" class="badge badge-info">Update</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection