<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class RSS extends Model
{    
    protected $table = 'rss';   
    
    protected $guarded = [];
    
    public function ft()
    {
        return FT::where('url_ft', 'like', '%feed%');
    }
}
