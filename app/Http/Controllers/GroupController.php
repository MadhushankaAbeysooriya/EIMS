<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use App\DataTables\GroupDataTable;
use Illuminate\Support\Facades\Crypt;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GroupDataTable $dataTable)
    {
        return $dataTable->render('groups.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('status',1)->get();
        $groups = Group::where('status',1)->get();

        return view('groups.create',compact('users','groups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(StoreGroupRequest $request)
    // {
    //     //dd($request);
    //     $finalArray = [];
    //     $groupIdsToUserIds = [];

    //     foreach ( $request->users as $value) {

    //         if (strpos($value, 'group_') === 0) {
    //             $groupId = substr($value, strlen('group_'));

    //             $group = Group::find($groupId);

    //             if ($group) {
    //                 $groupUserIds = $group->users->pluck('id')->toArray();
    //                 $groupIdsToUserIds[$groupId] = $groupUserIds;
    //             }
    //         } else {
    //             $finalArray[] = $value;
    //         }
    //     }

    //     // Adding unique user IDs from groups to the final array
    //     foreach ($groupIdsToUserIds as $userIds) {
    //         foreach ($userIds as $userId) {
    //             if (!in_array($userId, $finalArray)) {
    //                 $finalArray[] = $userId;
    //             }
    //         }
    //     }

    //     //dd($finalArray);

    //     $group = Group::create($request->all());

    //     if(!empty($finalArray)){
    //         $group->users()->sync($finalArray);
    //     }

    //     return redirect()->route('groups.index')->with('success','Group Created');
    // }

    public function store(StoreGroupRequest $request)
    {

        $group = Group::create($request->all());

        if(!empty($request->users)){
            $group->users()->sync($request->users);
        }

        if(!empty($request->groups)){
            $group->groups()->sync($request->groups);
        }

        return redirect()->route('groups.index')->with('success','Group Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $group = Group::find($id);

        return view('groups.show',compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $group = Group::find($id);

        $users = User::where('status',1)->get();

        $user_group = $group->users->pluck('name','name')->toArray();

        $groups = Group::where('status',1)->where('id', '<>', $id)->get();

        $group_group = $group->groups->pluck('name','name')->toArray();

        //dd($guardiance_student);

        return view('groups.edit',compact('group','users','user_group','groups','group_group'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $group->update($request->toArray());

        if(!empty($request->users)){
            $group->users()->sync($request->users);
        }else {
            $group->users()->detach();
        }

        if(!empty($request->groups)){
            $group->groups()->sync($request->groups);
        }else {
            $group->groups()->detach();
        }

        return redirect()->route('groups.index')->with('success', 'Group Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }

    public function inactive($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        Group::where('id',$id)->update(['status'=>'0']);

        return redirect()->route('groups.index')->with( 'success','Group De-Activated');
    }

    public function activate($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        Group::where('id',$id)->update(['status'=>'1']);
        return redirect()->route('groups.index')->with( 'success','Group Activated');
    }

    public function addUserView($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $group = Group::find($id);

        $users = User::where('status',1)->get();

        $user_group = $group->users->pluck('name','name')->toArray();

        $groups = Group::where('status',1)->where('id', '<>', $id)->get();

        $group_group = $group->groups->pluck('name','name')->toArray();

        return view('groups.add_users',compact('group','users','user_group','groups','group_group'));
    }

    public function addUserStore(Request $request, Group $group)
    {

        if(!empty($request->users)){
            $group->users()->sync($request->users);
        }else {
            $group->users()->detach();
        }

        if(!empty($request->groups)){
            $group->groups()->sync($request->groups);
        }else {
            $group->groups()->detach();
        }

        return redirect()->route('groups.index')->with('success', 'Users Added');
    }
}
