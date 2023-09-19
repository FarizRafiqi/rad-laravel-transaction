<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public $table = 'm_barang';

    protected $guarded = [];

    public function user_create()
    {
        return $this->belongsTo('App\Models\User', 'created_id', 'id');
    }

    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_id', 'id');
    }

}
