<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;

class MailsController extends Controller
{

    /**
     * Convert a file from word to PDF and save it.
     *
     */
    private function convertWordToPdf($word_file, $pdf_name)
    {
        \PhpOffice\PhpWord\Settings::setPdfRendererPath(base_path() . '/vendor/dompdf/dompdf');
        \PhpOffice\PhpWord\Settings::setPdfRendererName('DomPDF');
        $phpWord = \PhpOffice\PhpWord\IOFactory::load(public_path() . "/storage/word/" . $word_file, 'Word2007');
        $pdfWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'PDF');
        $pdfWriter->save(public_path() . "/storage/pdf/" . $pdf_name);
    }
    /**
     * Convert a file from word to HTML and save it.
     *
     */
    private function convertWordToHtml($word_file, $html_name)
    {
        $phpHTML = \PhpOffice\PhpWord\IOFactory::load(public_path() . "/storage/word/" . $word_file, 'Word2007');
        $HTMLWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpHTML, 'HTML');
        $HTMLWriter->save(public_path() . "/storage/html/" . $html_name);
    }

    /**
     * Convert HTML text to Word and then delete a certain word file that replaced by old one.
     *
     */
    private function convertWordToOthers($html_text, $word_file, $pdf_file, $html_file, $old_word_file, $old_pdf_file, $old_html_file)
    {
        $html_text = preg_replace('/<p\b[^>]*>(.*?)<\/p>/i', '', $html_text, 1);
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        \PhpOffice\PhpWord\Shared\Html::addHtml($section, $html_text);
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        Storage::delete('public/word/' . $old_word_file);
        $objWriter->save(public_path() . "/storage/word/" . $word_file);
        Storage::delete('public/pdf/' . $old_pdf_file);
        $this->convertWordToPdf($word_file, $pdf_file);
        Storage::delete('public/pdf/' . $old_html_file);
        $this->convertWordToHtml($word_file, $html_file);
    }
    /**
     * Convert HTML text to PDF and then delete a certain word file that replaced by old one.
     *
     */
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
        // Validator
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
            $this->convertWordToPdf($word_file, $pdf_file);
            // Convert word to HTML
            $this->convertWordToHtml($word_file, $html_file);
            $mail->no_surat = $request->renumber;
            $mail->user_id = auth()->user()->id;
            $mail->perihal = $request->subject;
            $mail->doc = $word_file;
            $mail->html = $html_file;
            $mail->pdf = $pdf_file;
            $this->dispatchLog(auth()->user()->name . ' Menambahkan Surat', 'tambah');
            $mail->save();
            return redirect('mails')->with('error', 'Surat tidak berhasil ditambahkan!');
        } else {
            return redirect('mails')->with('error', 'Surat tidak berhasil ditambahkan!');
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
    public function update(Request $request, $id)
    {
        $mail = Mail::find($id);
        $this->convertWordToOthers($request->surat, $mail->doc, $mail->pdf, $mail->html, $mail->doc, $mail->pdf, $mail->html);
        $mail->no_surat = $request->no_surat;
        $mail->perihal = $request->perihal;
        $mail->save();
        return redirect('mails')->with('success', "Surat dengan no surat <b>$mail->no_surat</b> berhasil diubah");
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
