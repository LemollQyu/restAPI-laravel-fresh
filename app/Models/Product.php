<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'image',
        'user_id',
        'name',
        'description',
        'price',
    ];

    // format yang ditampilkan
    // accessor untuk format datanya, yang diambil apa saja

    public function getApiResponseAttribute() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'image_url' => $this->getImageUrlAttribute(),
        ];
    }

    // acessor
    // untuk menampilkan path urlnya, format url imagenya
    public function getImageUrlAttribute(){

        // kondisi jika ada product yang tidak ada gambarnya
        if(is_null($this->image)) {
            return null;
        }

        return asset('storage/' . $this->image);
    }

    public function user() {
        return $this->belongTo(\App\Models\User::class);
    }
}
