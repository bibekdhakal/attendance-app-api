@extends('administrators.layouts.layout')
@section('content')
<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Students</h4>
            <!-- <p class="card-description"> Add class <code>.table-hover</code> -->
            </p>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Campus</th>
                        <th>Student Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$student->name}}</td>
                        <td>{{$student->email}}</td>
                        <td>{{$student->campus}}</td>
                        <td><button type="button" class="badge badge-success">{{$student->student_type}}</button></td>
                        <td><button type="button" class="badge badge-info">Update</button></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection