<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_produk extends Model
{
    protected $table='m_produk';

    public function supplier_r(){
        return $this->belongsTo('App\Models\M_supplier','supplier','id');
    }
}
