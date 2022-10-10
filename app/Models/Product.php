<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function jenisproduct()
    {
        return $this->belongsTo('App\Models\JenisProduct', 'jenis_id');
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
