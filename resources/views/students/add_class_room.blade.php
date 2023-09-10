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
                  <li class="breadcrumb-item active">Add Class Room</li>
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
                            <h3 class="card-title">Add Class Room for {{$student->name_initials}}</h3>
                            {{-- <div class="card-tools">
                                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                            </div> --}}
                        </div>

                        <form role="form" method="POST" action="{{route('students.add_class_room_store',$student->id)}}"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="card-body">

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="class_room_id">Class Room</label>
                                    <div class="col-sm-6">
                                        <select name="class_room_id" id="class_room_id" class="form-control">
                                            @foreach($classRooms as $item)
                                                <option value="{{ $item->id }}">
                                                    {{ $item->name}}
                                                </option>
                                            @endforeach
                                        </select>

                                        @error('class_room_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="from" class="col-sm-2 col-form-label">From</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control @error('from')
                                        is-invalid @enderror" name="from" value="{{ old('from') }}" id="from" autocomplete="off">
                                        <span class="text-danger">@error('from') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="to" class="col-sm-2 col-form-label">To</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control @error('to')
                                        is-invalid @enderror" name="to" value="{{ old('to') }}" id="to" autocomplete="off">
                                        <span class="text-danger">@error('to') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                </div>

                                <div class="card-footer">
                                    <a href="{{ url()->previous() }}" class="btn btn-sm bg-info"><i class="fa fa-arrow-circle-left"></i> Back</a>
                                        <button type="reset" class="btn btn-sm btn-secondary">Cancel</button>
                                        <button type="submit" class="btn btn-sm btn-success" >Update</button>
                                </div>
                            </div>

                        </form>

                        {{--  --}}

                        <div class="card-body">


                            <div class="col-sm-10">
                                <table class="table table-success table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Class</th>
                                            <th scope="col">From</th>
                                            <th scope="col">To</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($student->classRooms as $index => $item)
                                        {{-- {{dd($student->classRooms)}} --}}
                                            <tr>
                                                <th scope="row">{{ $index + 1 }}</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->pivot->from ? date('Y-m-d', strtotime($item->pivot->from)) : 'N/A' }}</td>
                                                <td>{{ $item->pivot->to ? date('Y-m-d', strtotime($item->pivot->to)) : 'N/A' }}</td>
                                                <td>
                                                    <form action="{{ route('class_rooms.destroy', ['class_room' => $item->pivot->id]) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </td>
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

@section('third_party_stylesheets')
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
@endsection

@section('third_party_scripts')
    {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}" ></script> --}}
    <script src="{{asset('plugins/select2/js/select2.js')}}" defer></script>
    <script>
        $(document).ready(function() {
            $('.multiple').select2();
        });
    </script>
@endsection
