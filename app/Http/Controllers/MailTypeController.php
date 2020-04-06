<?php

namespace App\Http\Controllers;

use App\MailType;
use App\Mail;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */private function getTypes()
    {
        $types = MailType::all();
        foreach ($types as $type) {
            $type->total_mails = count(Mail::where('type_id', $type->id)->get());
        }
        return $types;
    }
    public function index()
    {
        $types = $this->getTypes();
        return view('mail_type.index', compact('types'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $types = new MailType();
        $types->name = $request->name;
        $types->save();
        return redirect('type')->with('success', 'Jenis Surat berhasil ditambah!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $type = MailType::find($id);
        $type->name = $request->name;
        $type->save();
        return redirect('city')->with('success', 'Jenis Surat berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $types = MailType::findOrFail($id);
        $types->delete();
        return back()->with('success', 'Berhasil menghapus data jenis surat!');
    }
}
