<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase_order extends Model
{
    protected $table='purchase_order';

    public function suppliers(){
        return $this->belongsTo('App\Models\M_supplier','supplier');
    }

    public function statuss(){
        return $this->belongsTo('App\Models\M_status','status');
    }

    public function line(){
        return $this->hasMany('App\Models\Purchase_order_line','purchase_order');
    }

    public function grand_total(){
        $po = $this->id;

        $total=Purchase_order_line::where('purchase_order',$po)->sum('grand_total');
        return $total;
    }
}
