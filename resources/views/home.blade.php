@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row mt-2">

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3 class="text-white">{{ $active_users_count }}</h3>
                            <p class="text-white">Active Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users">
                            </i>
                        </div>
                        <a class="small-box-footer" href="{{route('users.index')}}">
                            More info
                            <i class="fas fa-arrow-circle-right">

                            </i>
                        </a>
                    </div>
                </div>

        </div>
    </div>
@endsection
