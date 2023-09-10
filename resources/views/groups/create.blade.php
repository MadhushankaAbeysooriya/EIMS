@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Group</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item ">Master Data</li>
                  <li class="breadcrumb-item ">Group Management</li>
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
                            <h3 class="card-title">Create New Group</h3>
                            {{-- <div class="card-tools">
                                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
                            </div> --}}
                        </div>

                        <form role="form" method="POST" action="{{route('groups.store')}}"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control @error('name')
                                        is-invalid @enderror" name="name" value="{{ old('name') }}" id="name" autocomplete="off">
                                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="users">Users</label>
                                    <div class="col-sm-6 select2-purple">
                                        <select name="users[]" id="users" class="multiple form-control" multiple>
                                            @foreach($users as $item)
                                                <option value="{{ $item->id }}">{{ $item->name}}</option>
                                            @endforeach
                                        </select>

                                        @error('users')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="groups">Groups</label>
                                    <div class="col-sm-6 select2-pink">
                                        <select name="groups[]" id="groups" class="multiple form-control" multiple>
                                            @foreach($groups as $item)
                                                <option value="{{ $item->id }}">{{ $item->name}}</option>
                                            @endforeach
                                        </select>

                                        @error('users')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <div class="form-group row">
                                    <label class="col-sm-2 col-form-label" for="users">Users and Groups</label>
                                    <div class="col-sm-6 select2-purple">
                                        <select name="users[]" id="users" class="multiple form-control" multiple>
                                            <optgroup label="Users">
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                                @endforeach
                                            </optgroup>
                                            <optgroup label="Groups">
                                                @foreach($groups as $group)
                                                    <option value="group_{{ $group->id }}">{{ $group->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        </select>
                                        @error('users')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div> --}}

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
@endsection

@section('third_party_scripts')
    {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}" ></script> --}}
    <script src="{{asset('plugins/select2/js/select2.js')}}" defer></script>
    <script>
        $(document).ready(function() {
            $('.multiple').select2();
        });

        // $(document).ready(function() {
        //     $('.multiple').select2();

        //     $('#users').on('select2:select', function(e) {
        //         var selectedGroup = [];
        //         var selectedGroupUsers = [];
        //         var value = e.params.data.id;

        //         if (value.startsWith('group_')) {
        //             selectedGroup = value.replace('group_', '');
        //             selectedGroupUsers = [];
        //             console.log(selectedGroup);

        //             // Mark the group and users within that group
        //             $('#users').val([selectedGroup]).trigger('change');
        //             $.ajax({
        //                 type: 'GET',
        //                 url: '{{ route("users.getUsersByGroup", ["group_id" => "_group_id_"]) }}'.replace('_group_id_', selectedGroup),
        //                 success: function(data) {
        //                     $.each(data, function(key, value) {
        //                         selectedGroupUsers.push(value.id);
        //                     });
        //                     $('#users').val(selectedGroupUsers.concat(selectedGroup)).trigger('change');
        //                 }
        //             });
        //         } else {
        //             if (selectedGroup) {
        //                 selectedGroupUsers.push(value);
        //             }
        //         }
        //     });

        //     $('#users').on('select2:unselect', function(e) {
        //         var value = e.params.data.id;
        //         if (value == selectedGroup) {
        //             selectedGroup = null;
        //             selectedGroupUsers = [];
        //         } else if (selectedGroupUsers.includes(value)) {
        //             selectedGroupUsers.splice(selectedGroupUsers.indexOf(value), 1);
        //         }
        //     });
        // });

        // $(document).ready(function() {
        //     $('.multiple').select2();

        //     var selectedGroup = null;
        //     var selectedGroupUsers = [];

        //     $('#users').on('select2:select', function(e) {
        //         var value = e.params.data.id;
        //         if (value.startsWith('group_')) {
        //             selectedGroup = value.replace('group_', '');
        //             selectedGroupUsers = [];

        //             // Mark the group
        //             $('#users').val([selectedGroup]).trigger('change');
        //             $.ajax({
        //                 type: 'GET',
        //                 url: '{{ route("users.getUsersByGroup", ["group_id" => "_group_id_"]) }}'.replace('_group_id_', selectedGroup),
        //                 success: function(data) {
        //                     $.each(data, function(key, value) {
        //                         selectedGroupUsers.push(value.id);
        //                     });

        //                     // Mark the group users
        //                     $('#users').val(selectedGroupUsers.concat(selectedGroup)).trigger('change');
        //                 }
        //             });
        //         } else {
        //             if (selectedGroup) {
        //                 selectedGroupUsers.push(value);
        //             }
        //         }
        //     });

        //     $('#users').on('select2:unselect', function(e) {
        //         var value = e.params.data.id;
        //         if (value == selectedGroup) {
        //             selectedGroup = null;
        //             selectedGroupUsers = [];
        //         } else if (selectedGroupUsers.includes(value)) {
        //             selectedGroupUsers.splice(selectedGroupUsers.indexOf(value), 1);
        //         }
        //     });
        // });

        //////////////////////////////////////
        // $(document).ready(function() {
        //     $('.multiple').select2();

        //     var selectedGroup = null;
        //     var selectedGroupUsers = [];

        //     $('#users').on('select2:select', function(e) {
        //         var value = e.params.data.id;

        //         if (value.startsWith('group_')) {
        //             selectedGroup = value.replace('group_', '');
        //             selectedGroupUsers = [];

        //             // Fetch users for the selected group
        //             $.ajax({
        //                 type: 'GET',
        //                 url: '{{ route("users.getUsersByGroup", ["group_id" => "_group_id_"]) }}'.replace('_group_id_', selectedGroup),
        //                 success: function(data) {
        //                     $.each(data, function(key, user) {
        //                         selectedGroupUsers.push(user.id);
        //                     });

        //                     // Add the selected group and its users to the existing selection
        //                     var existingSelection = $('#users').val() || [];
        //                     $('#users').val(existingSelection.concat(selectedGroupUsers, 'group_' + selectedGroup)).trigger('change');
        //                 }
        //             });
        //         } else {
        //             if (selectedGroup) {
        //                 selectedGroupUsers.push(value);
        //             }
        //         }
        //     });

        //     $('#users').on('select2:unselect', function(e) {
        //         var value = e.params.data.id;

        //         if (value == 'group_' + selectedGroup) {
        //             selectedGroup = null;
        //             selectedGroupUsers = [];
        //         } else if (selectedGroupUsers.includes(value)) {
        //             selectedGroupUsers.splice(selectedGroupUsers.indexOf(value), 1);
        //         }
        //     });
        // });
        ///////////////////////////////
        // $(document).ready(function() {
        //     $('.multiple').select2();

        //     var selectedGroup = null;
        //     var selectedGroupUsers = [];

        //     $('#users').on('select2:select', function(e) {
        //         var value = e.params.data.id;

        //         if (value.startsWith('group_')) {
        //             selectedGroup = value.replace('group_', '');
        //             selectedGroupUsers = [];

        //             // Fetch users for the selected group
        //             $.ajax({
        //                 type: 'GET',
        //                 url: '{{ route("users.getUsersByGroup", ["group_id" => "_group_id_"]) }}'.replace('_group_id_', selectedGroup),
        //                 success: function(data) {
        //                     $.each(data, function(key, user) {
        //                         selectedGroupUsers.push(user.id);
        //                     });

        //                     // Add the selected group users to the existing selection
        //                     var existingSelection = $('#users').val() || [];
        //                     $('#users').val(existingSelection.concat(selectedGroupUsers)).trigger('change');
        //                 }
        //             });
        //         } else {
        //             if (selectedGroup) {
        //                 selectedGroupUsers.push(value);
        //             }
        //         }
        //     });

        //     $('#users').on('select2:unselect', function(e) {
        //         var value = e.params.data.id;

        //         if (value == 'group_' + selectedGroup) {
        //             selectedGroup = null;
        //             selectedGroupUsers = [];
        //         } else if (selectedGroupUsers.includes(value)) {
        //             selectedGroupUsers.splice(selectedGroupUsers.indexOf(value), 1);
        //         }
        //     });
        // });

        // $(document).ready(function() {
        //     $('.multiple').select2();

        //     var selectedGroup = null;
        //     var selectedGroupUsers = [];

        //     $('#users').on('select2:select', function(e) {
        //         var value = e.params.data.id;
        //         if (value.startsWith('group_')) {
        //             selectedGroup = value.replace('group_', '');
        //             selectedGroupUsers = [];
        //             console.log(selectedGroup);

        //             // Fetch users for the selected group
        //             $.ajax({
        //                 type: 'GET',
        //                 url: '{{ route("users.getUsersByGroup", ["group_id" => "_group_id_"]) }}'.replace('_group_id_', selectedGroup),
        //                 success: function(data) {
        //                     $.each(data, function(key, user) {
        //                         selectedGroupUsers.push(user.id);
        //                     });

        //                     // Add the selected group and its users to the existing selection
        //                     var existingSelection = $('#users').val() || [];
        //                     $('#users').val(existingSelection.concat(selectedGroupUsers)).trigger('change');
        //                 }
        //             });
        //         } else {
        //             if (selectedGroup) {
        //                 selectedGroupUsers.push(value);
        //             }
        //         }
        //     });

        //     $('#users').on('select2:unselect', function(e) {
        //         var value = e.params.data.id;
        //         if (value == 'group_' + selectedGroup) {
        //             selectedGroup = null;
        //             selectedGroupUsers = [];
        //         } else if (selectedGroupUsers.includes(value)) {
        //             selectedGroupUsers.splice(selectedGroupUsers.indexOf(value), 1);
        //         }
        //     });
        // });
    </script>
@endsection
