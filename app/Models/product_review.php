<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_review extends Model
{
    use HasFactory;
    protected $table = 'product_review';
    protected $fillable = ['product_review_id', 'user_id', 'product_id', 'rating', 'comment', 'created_at', 'modified_at'];
    protected $primaryKey = 'product_review_id';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
