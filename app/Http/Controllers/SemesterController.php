<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use App\DataTables\SemesterDataTable;
use App\Http\Requests\StoreSemesterRequest;
use App\Http\Requests\UpdateSemesterRequest;
use Illuminate\Support\Facades\Crypt;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SemesterDataTable $dataTable)
    {
        return $dataTable->render('semesters.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('semesters.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSemesterRequest $request)
    {
        Semester::create($request->all());
        return redirect()->route('semesters.index')->with('success','Semester Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $semester = Semester::find($id);

        return view('semesters.show',compact('semester'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $semester = Semester::find($id);

        return view('semesters.edit',compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSemesterRequest $request, Semester $semester)
    {
        $semester->update($request->toArray());
        return redirect()->route('semesters.index')->with('message', 'Semester Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        //
    }

    public function inactive($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        Semester::where('id',$id)->update(['status'=>'0']);
        return redirect()->route('semesters.index')->with( 'success','Semester De-Activated');
    }

    public function activate($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        Semester::where('id',$id)->update(['status'=>'1']);
        return redirect()->route('semesters.index')->with( 'success','Semester Activated');
    }
}
