<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Leito extends Model
{
    protected $fillable = [
        'status',
    ];

    public function user() {
        return $this->belongsTo('App\User', 'id_upa');
    }
}
