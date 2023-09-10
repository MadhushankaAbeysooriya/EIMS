<?php

namespace App\Http\Controllers;

use App\Models\GuardianceType;
use Illuminate\Http\Request;
use App\DataTables\GuardianceTypeDataTable;
use App\Http\Requests\StoreGuardianceTypeRequest;
use App\Http\Requests\UpdateGuardianceTypeRequest;
use Illuminate\Support\Facades\Crypt;

class GuardianceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GuardianceTypeDataTable $dataTable)
    {
        return $dataTable->render('guardiance_types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('guardiance_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuardianceTypeRequest $request)
    {
        GuardianceType::create($request->all());
        return redirect()->route('guardiance_types.index')->with('success','Guardiance Type Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $guardiance_type = GuardianceType::find($id);

        return view('guardiance_types.show',compact('guardiance_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $guardiance_type = GuardianceType::find($id);

        return view('guardiance_types.edit',compact('guardiance_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuardianceTypeRequest $request, GuardianceType $guardiance_type)
    {
        $guardiance_type->update($request->toArray());
        return redirect()->route('guardiance_types.index')->with('message', 'Guardiance Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GuardianceType $guardianceType)
    {
        //
    }

    public function inactive($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        GuardianceType::where('id',$id)->update(['status'=>'0']);
        return redirect()->route('guardiance_types.index')->with( 'success','Guardiance Type De-Activated');
    }

    public function activate($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        GuardianceType::where('id',$id)->update(['status'=>'1']);
        return redirect()->route('guardiance_types.index')->with( 'success','Guardiance Type Activated');
    }
}
