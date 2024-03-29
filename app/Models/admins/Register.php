<?php

namespace App\Models\admins;
use Illuminate\Database\Eloquent\Model;


class Register extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'name',
        'date',
        'admin_id',
        'active',
    ];

    public function admin(){
        return $this->belongsTo(Admin::Class,'admin_id');
    }

}
