<?php

namespace App\Models\Admin;

use App\Models\Owner\KatalogMakeup;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $guarded = [''];

    protected $table = 'content';

    public function getMakeup()
    {
        return $this->belongsTo(KatalogMakeup::class, 'id_makeup', 'id');
    }
}
