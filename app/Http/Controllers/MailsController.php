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
        $request->validate([
            'pdf' => 'mimes:pdf|max:4096',
            'docx' => 'mimes:doc,docx,zip|max:4096'
        ]);
        if ($request->hasFile('pdf') || $request->hasFile('docx')) {
            $mail = new Mail();
            $file = $request->file('docx');
            $word_file = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . $file->getClientOriginalExtension();
            $pdf_file = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . 'pdf';
            $html_file = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME) . '_' . time() . '.' . 'html';
            $request->file('docx')->storeAs('public/word', $word_file);

            // Convert word to PDF
            \PhpOffice\PhpWord\Settings::setPdfRendererPath(base_path() . '/vendor/dompdf/dompdf');
            \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
            $phpWord = \PhpOffice\PhpWord\IOFactory::load(public_path() . "/storage/word/" . $word_file, 'Word2007');
            $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
            $pdfWriter->save(public_path() . "/storage/pdf/" . $pdf_file);
            // Convert word to HTML
            $phpHTML = \PhpOffice\PhpWord\IOFactory::load(public_path() . "/storage/word/" . $word_file, 'Word2007');
            $HTMLWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpHTML, 'HTML');
            $HTMLWriter->save(public_path() . "/storage/html/" . $html_file);


            $mail->no_surat = $request->renumber;
            $mail->user_id = auth()->user()->id;
            $mail->perihal = $request->subject;
            $mail->doc = $word_file;
            $mail->html = $html_file;
            $mail->pdf = $pdf_file;
            $this->dispatchLog(auth()->user()->name . ' Menambahkan Surat', 'tambah');
            $mail->save();
            return redirect()->route('mail.index')->with('error', 'Surat tidak berhasil ditambahkan!');
        } else {
            return redirect()->route('mail.index')->with('error', 'Surat tidak berhasil ditambahkan!');
        }
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
    public function edit($id)
    {
        $mail = Mail::find($id);
        return view('mails.edit', compact('mail'));
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
        DB::table('mails')->where('id', $id)->delete();
        return redirect()->route('mail.index')->withStatus(__('Mail successfully deleted.'));
    }
}
