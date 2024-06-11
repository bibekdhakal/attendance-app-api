@extends('administrators.layouts.layout')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Units</h4>
            <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
            </p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Unit Name</th>
                        <th>Unit Code</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($units as $unit)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$unit->unit_name}}</td>
                        <td>Code</td>
                        <td><button type="button" class="badge badge-info">Update</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection