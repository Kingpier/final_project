<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Toy extends Model
{
    use HasFactory;

    protected $primaryKey = 'toy_id';
    protected $keyType = 'string';

    protected $fillable = [
        'category_id', 'image', 'name', 'description', 'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }
}
