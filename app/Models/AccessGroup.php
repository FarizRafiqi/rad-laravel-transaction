<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AccessGroup extends Model
{
    public $table = 'access_group';
    public function user_create()
    {
        return $this->belongsTo('App\Models\User', 'created_id', 'id');
    }

    public function user_update()
    {
        return $this->belongsTo('App\Models\User', 'updated_id', 'id');
    }

    public function access_masters()
    {
        return $this->belongsToMany('App\Models\AccessMaster', 'access_group_detail', 'id_access_group', 'id_access_master')->withPivot('priority');
    }

    public function users()
    {
        return $this->hasMany('App\Models\User', 'id_access_group', 'id');
    }
}
