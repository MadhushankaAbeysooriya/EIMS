<?php

namespace App\Http\Controllers;

use App\Models\ClassRoom;
use App\Models\StudentClass;
use App\Models\Student;
use Illuminate\Http\Request;
use App\DataTables\ClassRoomDataTable;
use App\Http\Requests\StoreClassRoomRequest;
use App\Http\Requests\UpdateClassRoomRequest;
use Illuminate\Support\Facades\Crypt;

class ClassRoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ClassRoomDataTable $dataTable)
    {
        return $dataTable->render('class_rooms.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('class_rooms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClassRoomRequest $request)
    {
        ClassRoom::create($request->all());
        return redirect()->route('class_rooms.index')->with('success','Class Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $class_room = ClassRoom::find($id);

        return view('class_rooms.show',compact('class_room'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $class_room = ClassRoom::find($id);

        return view('class_rooms.edit',compact('class_room'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClassRoomRequest $request, ClassRoom $class_room)
    {
        $class_room->update($request->toArray());
        return redirect()->route('class_rooms.index')->with('message', 'Class Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($class_room)
    {
        $studentClass = StudentClass::findOrFail($class_room);
        $studentClass->delete();

        return redirect()->route('students.add_class_room_view',Crypt::encrypt($studentClass->student_id))->with( 'success','Class Deleted');
    }


    public function inactive($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        ClassRoom::where('id',$id)->update(['status'=>'0']);
        return redirect()->route('class_rooms.index')->with( 'success','Class De-Activated');
    }

    public function activate($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        ClassRoom::where('id',$id)->update(['status'=>'1']);
        return redirect()->route('class_rooms.index')->with( 'success','Class Activated');
    }
}
