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
                  <li class="breadcrumb-item active">Create</li>
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
                            <h3 class="card-title">Create New Student</h3>
                            {{-- <div class="card-tools">
                                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                            </div> --}}
                        </div>

                        <form role="form" method="POST" action="{{route('students.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="admission" class="col-sm-2 col-form-label">Admission</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('admission')
                                        is-invalid @enderror" name="admission" value="{{ old('admission') }}" id="admission" autocomplete="off">
                                        <span class="text-danger">@error('admission') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="name_initials" class="col-sm-2 col-form-label">Name(with initials)</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('name_initials')
                                        is-invalid @enderror" name="name_initials" value="{{ old('name_initials') }}" id="name_initials" autocomplete="off">
                                        <span class="text-danger">@error('name_initials') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="full_name" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('full_name')
                                        is-invalid @enderror" name="full_name" value="{{ old('full_name') }}" id="full_name" autocomplete="off">
                                        <span class="text-danger">@error('full_name') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="dob" class="col-sm-2 col-form-label">Date of Birth</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control @error('dob')
                                        is-invalid @enderror" name="dob" value="{{ old('dob') }}" id="dob" autocomplete="off">
                                        <span class="text-danger">@error('dob') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="gender">Gender</label>
                                    <div class="col-sm-6">
                                        <select required name="gender" id="gender"
                                            class="form-control">
                                                <option value="0">Female</option>
                                                <option value="1">Male</option>
                                        </select>

                                    @error('gender')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="enlist_date" class="col-sm-2 col-form-label">Enlisted Date</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control @error('enlist_date')
                                        is-invalid @enderror" name="enlist_date" value="{{ old('enlist_date') }}" id="enlist_date" autocomplete="off">
                                        <span class="text-danger">@error('enlist_date') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="address" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-6">
                                        <textarea name="address" class="form-control" rows="4">{{ old('address') }}</textarea>
                                        <span class="text-danger">@error('address') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                </div>
                                <div class="card-footer">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                        <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-success" >Create</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>
@endsection

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
@stop

@section('third_party_scripts')

<script src="{{ asset('plugins/select2/js/select2.min.js') }}" defer></script>
<script>

$(document).ready(function() {
    $('.js-example-basic-multiple').select2();
});
    <script src="{{ asset('plugins/jquery/jquery.js') }}"></script>
    <script>

        $(document).ready(function () {
            $('#roles').select2();
        });
    </script>
@stop
