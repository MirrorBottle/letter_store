<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;

class Mail extends Model
{
    // public function getDateIndoAttribute()
    // {
    //     $date = Carbon::parse($this->created_at);
    //     return to_indo_day($date->copy()->format('N')) . ', ' . to_indo_date($date->copy()->format('Y-m-d'), 1);
    // }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
