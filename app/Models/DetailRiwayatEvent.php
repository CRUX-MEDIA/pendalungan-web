<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailRiwayatEvent extends Model
{
    use HasFactory;
    protected $table = 'detail_riwayat_event';

    public function riwayat_event() {
        return $this->belongsTo('App\Models\RiwayatEvent', 'id_riwayat_event');
    }
    
    public function user() {
        return $this->belongsTo('App\Models\User', 'id_user');
    }

    public function jobdesc_event() {
        return $this->belongsTo('App\Models\JobdescEvent', 'id_jobdesc');
    }
}
