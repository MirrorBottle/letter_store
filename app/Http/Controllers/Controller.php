<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
