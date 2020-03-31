<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase_order_line extends Model
{
    protected $table='purchase_order_line';
    public $timestamps=false;

    public function produks(){
        return $this->belongsTo('App\Models\M_produk','produk');
    }
}
