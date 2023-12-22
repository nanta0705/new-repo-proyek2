<?php

namespace App\Models\Owner;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailMakeup extends Model
{
    use HasFactory;

    protected $guarded = [''];
    protected $table = 'detail_makeup';

    public function getType()
    {
        return $this->belongsTo(TypeMakeup::class, 'id_type_makeup');
    }
}
