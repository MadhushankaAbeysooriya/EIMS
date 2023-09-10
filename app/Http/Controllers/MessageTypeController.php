<?php

namespace App\Http\Controllers;

use App\Models\MessageType;
use Illuminate\Http\Request;
use App\DataTables\MessageTypeDataTable;
use App\Http\Requests\StoreMessageTypeRequest;
use App\Http\Requests\UpdateMessageTypeRequest;
use Illuminate\Support\Facades\Crypt;

class MessageTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MessageTypeDataTable $dataTable)
    {
        return $dataTable->render('message_types.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('message_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMessageTypeRequest $request)
    {
        MessageType::create($request->all());
        return redirect()->route('message_types.index')->with('success','Message Type Created');
    }

    /**
     * Display the specified resource.
     */
    public function show($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $message_type = MessageType::find($id);

        return view('message_types.show',compact('message_type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($encryptedId)
    {
        $id = Crypt::decrypt($encryptedId);

        $message_type = MessageType::find($id);

        return view('message_types.edit',compact('message_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMessageTypeRequest $request, MessageType $message_type)
    {
        $message_type->update($request->toArray());
        return redirect()->route('message_types.index')->with('message', 'Message Type Updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MessageType $messageType)
    {
        //
    }

    public function inactive($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        MessageType::where('id',$id)->update(['status'=>'0']);
        return redirect()->route('message_types.index')->with( 'success','Message Type De-Activated');
    }

    public function activate($encryptedId){
        $id = Crypt::decrypt($encryptedId);

        MessageType::where('id',$id)->update(['status'=>'1']);
        return redirect()->route('message_types.index')->with( 'success','Message Type Activated');
    }
}
