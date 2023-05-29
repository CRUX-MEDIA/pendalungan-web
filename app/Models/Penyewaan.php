<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;
    protected $table = 'penyewaan';
    protected $primaryKey = 'id_sewa';

    public function user() {
        return $this->belongsTo('App\Models\User', 'id_user');
        return $this->belongsTo('App\Models\User', 'id_penyewa');
    }

    public function status_sewa() {
        return $this->belongsTo('App\Models\StatusSewa', 'id_status_sewa');
    }

    public function jaminan() {
        return $this->belongsTo('App\Models\Jaminan', 'id_jaminan');
    }

    public function detail_penyewaan() {
        return $this->hasMany('App\Models\DetailPenyewaan', 'id_sewa');
    }
}
