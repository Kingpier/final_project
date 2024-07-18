<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'invoice_detail_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->invoice_detail_id = Str::uuid();
        });
    }

    protected $fillable = ['invoice_header_id', 'toy_id', 'quantity', 'subTotal'];

    public function invoice()
    {
        return $this->belongsTo(InvoiceHeader::class, 'invoice_header_id', 'invoice_header_id');
    }

    public function toy()
    {
        return $this->belongsTo(Toy::class, 'toy_id', 'toy_id');
    }
}
