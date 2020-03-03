<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail;

class MailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mails = Mail::all();
        $mails = DB::table('mails')->get();
        // dd
        ($mails);
        return view('mails.index', ['mails' => $mails]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('mails.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        DB::table('mails')->insert([
            'no_surat' => $request->renumber,
            'perihal' => $request->subject,
            'doc' => $request->docx,
            'pdf' => $request->pdf,
            'user_id' => auth()->user()->id,
            'html' => $request->html
        ]);


        return redirect()->route('mail.index')->withStatus(__('Mail successfully created.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mail $mails)
    {
        $mails = DB::table("mails")->where('ID', $mails)->get();
        return view ('mails.edit', compact('mails'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $mails)
    {
        DB::table('mails')->where('id', $request->id->update([
            'no_surat' => $request->renumber,
            'perihal' => $request->subject,
            'doc' => $request->docx,
            'pdf' => $request->pdf
        ]));
        return redirect('/mail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('mails')->where('id',$id)->delete();
        return redirect()->route('mail.index')->withStatus(__('Mail successfully deleted.'));
    }
}
