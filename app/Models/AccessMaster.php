<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Models\AccessGroup;

class AccessMaster extends Model
{
    public $table = 'access_master';

    public function user_create()
    {
        return $this->belongsTo('App\Models\User', 'created_id', 'id');
    }

    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_id', 'id');
    }

    public function access_groups()
    {
        return $this->belongsToMany(AccessGroup::class, 'access_group_detail', 'id_access_master', 'id_access_group')->withPivot('priority');
    }
}
