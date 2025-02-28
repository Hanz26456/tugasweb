<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'isbn',
        'category_id',
        'location',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}



