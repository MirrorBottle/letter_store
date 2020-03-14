<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Log;
use App\City;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $this->middleware('auth');
        View::share('sidebar_cities', (object) City::all());
    }

    public function dispatchLog($message, $activity = null)
    {
        Log::insert([
            'user_id' => auth()->user()->id,
            'message' => $message,
            'activity' => $activity != null ? $activity : null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
