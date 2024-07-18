<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->user_id = Str::uuid();
        });
    }

    protected $fillable = [
        'firstName', 'lastName', 'email', 'password', 'role', 'money',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function invoices()
    {
        return $this->hasMany(InvoiceHeader::class, 'user_id', 'user_id');
    }
}
