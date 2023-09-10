<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\ClassRoom;
use App\Models\StudentClass;
use Illuminate\Http\Request;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\DataTables\StudentDataTable;
use Illuminate\Support\Facades\Crypt;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(StudentDataTable $dataTable)
    {
        return $dataTable->render('students.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        Student::create($request->all());
        return redirect()->route('students.index')->with('success','Student Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $student = Student::find($id);

        return view('students.show',compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $student = Student::find($id);

        return view('students.edit',compact('student'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update($request->toArray());
        return redirect()->route('students.index')->with('message', 'Student Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        //
    }

    public function inactive($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        Student::where('id',$id)->update(['status'=>'0']);
        return redirect()->route('students.index')->with( 'success','Student De-Activated');
    }

    public function activate($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        Student::where('id',$id)->update(['status'=>'1']);
        return redirect()->route('students.index')->with( 'success','Student Activated');
    }

    public function addClassRoomView($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $student = Student::with('classRooms')->find($id);

        $classRooms = ClassRoom::where('status',1)->get();

        return view('students.add_class_room',compact('student','classRooms'));
    }

    public function addClassRoomStore(Request $request, Student $student)
    {
        //dd($request);
        $input = $request->all();
        //dd($input);

        StudentClass::create([
            'student_id' => $student->id,
            'class_room_id' => $input['class_room_id'],
            'from' => $input['from'],
            'to' => $input['to'],
        ]);

        // $student->classRooms()->create([
        //     'class_room_id' => $input['class_room_id'],
        //     'from' => $input['from'],
        //     'to' => $input['to'],
        // ]);

        // if(!empty($input['students'])){

        // }else {
        //     $guardiance->students()->detach();
        // }

        return redirect()->route('students.add_class_room_view',Crypt::encrypt($student->id))->with('success', 'Class Added');
    }
}
