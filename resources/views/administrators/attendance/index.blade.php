@extends('administrators.layouts.layout')
@section('content')
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title"> Attendance </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Attendance</a></li>
                <li class="breadcrumb-item active" aria-current="page">List</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Student</th>
                                <th>Campus</th>
                                <th>Unit</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($records as $record)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$record->name}}</td>
                                <td>{{$record->campus}}</td>
                                <td>{{$record->unit}}</td>
                                <td>{{date('Y-m-d', strtotime($record->date))}}</td>
                                <td><span class="badge {{$record->status == 'Present' ? 'badge-success' : 'badge-danger'}}">{{$record->status}}</span></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection