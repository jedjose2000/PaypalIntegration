<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    use HasFactory;

    protected $table = 'tblorderhistory';
    protected $primaryKey = 'orderId';
    protected $fillable = ['orderDate', 'accountId', 'itemName','totalPrice','initialprice','quantity','paymentType','refNum'];

    public $timestamps = false;

    public function viewProducts($id)
    {
        return $this->where('orderId', $id)->get();
    }
}
