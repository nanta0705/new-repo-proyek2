<?php

namespace App\Models\Owner;

use App\Models\Admin\Content;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KatalogMakeup extends Model
{
    use HasFactory;


    protected $guarded = [];

    protected $table = 'katalog_makeup';

    public function getUserMakeup()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function detailMakeup()
    {
        return $this->hasMany(DetailMakeup::class, 'id_makeup');
    }

    public function managementContent()
    {
        return $this->hasOne(Content::class, 'id_makeup');
    }
}
