<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->category_id = Str::uuid();
        });
    }

    protected $fillable = ['name'];

    public function toys()
    {
        return $this->hasMany(Toy::class, 'category_id', 'category_id');
    }
}
