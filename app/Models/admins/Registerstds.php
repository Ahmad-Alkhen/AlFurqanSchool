<?php

namespace App\Models\admins;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Registerstds extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'registerstd';
    public $timestamps = false;

    protected $fillable = [
        'register_id',
        'user_id',
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

}