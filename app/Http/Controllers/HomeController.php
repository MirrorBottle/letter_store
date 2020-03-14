<?php

namespace App\Http\Controllers;

use App\Log;
use App\Mail;
use App\MailType;
use App\City;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $mails = count(Mail::all());
        $deleted = count(Log::where('activity', 'hapus')->get());
        $added = count(Log::where('activity', 'tambah')->get());
        $printed = count(Log::where('activity', 'cetak')->get());
        $mail_types = count(MailType::all());
        $cities = count(City::all());
        $logs = Log::latest()->take(4)->get();
        return view('dashboard', compact('mails', 'deleted', 'added', 'printed', 'logs', 'mail_types', 'cities'));
    }
}
