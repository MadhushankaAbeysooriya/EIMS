@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Students</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Student Management</li>
                  <li class="breadcrumb-item active">View</li>
                </ol>
            </div>
          </div>
    </section>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-cyan">
                <div class="card-header">
                    <h3 class="card-title">View Student</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('students.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Admission:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $student->admission }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Name(with initials):</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $student->name_initials }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Full Name:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $student->full_name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Date of Birth:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $student->dob }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Gender:</strong>
                        </label>
                        <div class="col-sm-10">
                            @switch($student->gender)
                                @case(0)
                                    <label class="badge badge-primary">Female</label>
                                    @break
                                @case(1)
                                    <label class="badge badge-danger">Male</label>
                                    @break
                                @default
                                    <label class="badge badge-secondary">Unknown</label>
                            @endswitch
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Enlisted Date:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $student->enlist_date }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Address:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $student->address }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Status:</strong>
                        </label>
                        <div class="col-sm-10">
                            @if($student->status == 1)
                                <label class="badge badge-primary">Active</label>
                            @else
                                <label class="badge badge-warning">Inactive</label>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
