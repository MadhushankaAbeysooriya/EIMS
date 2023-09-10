@extends('layouts.app')


@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Guardiance Types</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Guardiance Type Management</li>
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
                    <h3 class="card-title">View Guardiance Type</h3>
                    <div class="card-tools">
                        <a class="btn btn-primary" href="{{ route('guardiance_types.index') }}"> Back</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Guardiance Type Name:</strong>
                        </label>
                        <div class="col-sm-10">
                            {{ $guardiance_type->name }}
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-sm-2">
                            <strong>Status:</strong>
                        </label>
                        <div class="col-sm-10">
                            @if($guardiance_type->status == 1)
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
