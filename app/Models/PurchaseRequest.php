<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    use HasFactory;

    public $table = 'beli_minta';

    public function user_create()
    {
        return $this->belongsTo('App\Models\User', 'created_id', 'id');
    }

    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_id', 'id');
    }

    public function userPemohon()
    {
        return $this->belongsTo(User::class, 'id_user_pemohon', 'id');
    }

    public function userMenyetujui()
    {
        return $this->belongsTo(User::class, 'id_user_menyetujui', 'id');
    }
}
