<?php

namespace App\Http\Controllers;

use App\Models\Guardiance;
use App\Models\GuardianceType;
use App\Models\User;
use App\Models\Student;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\DataTables\GuardianceDataTable;
use App\Http\Requests\StoreGuardianceRequest;
use App\Http\Requests\UpdateGuardianceRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class GuardianceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GuardianceDataTable $dataTable)
    {
        return $dataTable->render('guardiances.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        $guardiance_types = GuardianceType::where('status',1)->get();
        $students = Student::where('status',1)->get();

        return view('guardiances.create',compact('roles','guardiance_types','students'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuardianceRequest $request)
    {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        //$user->academic_staff()::create($input);

        $guardiance = Guardiance::create([
            'sec_contact' => $input['sec_contact'],
            'nic' => $input['nic'],
            'guardiance_type_id' => $input['guardiance_type_id'],
            'user_id' => $user->id,
        ]);

        if(!empty($input['students'])){
            $guardiance->students()->sync($input['students']);
        }

        return redirect()->route('guardiances.index')->with('success','Guardiance Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $guardiance = Guardiance::find($id);

        return view('guardiances.show',compact('guardiance'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $guardiance = Guardiance::find($id);

        $roles = Role::pluck('name','name')->all();
        $userRole = $guardiance->user->roles->pluck('name','name')->toArray();

        $guardiance_types = GuardianceType::where('status',1)->get();
        $students = Student::where('status',1)->get();

        $guardiance_student = $guardiance->students->pluck('name_initials','name_initials')->toArray();

        //dd($guardiance_student);

        return view('guardiances.edit',compact('guardiance','roles','userRole','guardiance_types','students','guardiance_student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuardianceRequest $request, Guardiance $guardiance)
    {
        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = $guardiance->user;

        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$user->id)->delete();
        $user->assignRole($request->input('roles'));

        $guardiance->update($input);

        if(!empty($input['students'])){
            $guardiance->students()->sync($input['students']);
        }else {
            $guardiance->students()->detach();
        }

        return redirect()->route('guardiances.index')->with('success', 'Guardiance Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guardiance $guardiance)
    {
        //
    }

    public function inactive($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        $guardiance = Guardiance::find($id);

        User::where('id',$guardiance->user_id)->update(['status'=>'0']);
        return redirect()->route('guardiances.index')->with( 'success','Guardiance De-Activated');
    }

    public function activate($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        $guardiance = Guardiance::find($id);

        User::where('id',$guardiance->user_id)->update(['status'=>'1']);
        return redirect()->route('guardiances.index')->with( 'success','Guardiance Activated');
    }

    public function addChildrenView($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $guardiance = Guardiance::find($id);

        $students = Student::where('status',1)->get();

        $guardiance_student = $guardiance->students->pluck('name_initials','name_initials')->toArray();

        return view('guardiances.add_children',compact('guardiance','students','guardiance_student'));
    }

    public function addChildrenStore(Request $request, Guardiance $guardiance)
    {
        $input = $request->all();

        if(!empty($input['students'])){
            $guardiance->students()->sync($input['students']);
        }else {
            $guardiance->students()->detach();
        }

        return redirect()->route('guardiances.index')->with('success', 'Children Added');
    }
}
