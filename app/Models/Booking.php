<?php

namespace App\Models;

use App\Models\Owner\KatalogMakeup;
use App\Models\Owner\TypeMakeup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = "booking";

    protected $guarded = [''];

    public $primaryKey = "id_booking";

    protected $keyType = 'string';

    public $incrementing = false;

    // public $timestamps = false;

    public function getCustomer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id_customer');
    }

    public function getmakeup()
    {
        return $this->belongsTo(KatalogMakeup::class, 'makeup', 'id');
    }

    public function getTypeMakeup()
    {
        return $this->belongsTo(TypeMakeup::class, 'type_makeup', 'id');
    }

    public function getUserMakeup()
    {
        return $this->belongsTo(KatalogMakeup::class, 'user_id_mua', 'user_id');
    }
}
