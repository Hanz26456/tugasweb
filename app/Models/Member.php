<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members'; // Pastikan tabel ini benar di database

    protected $fillable = [
        'name', 'address', 'phone', 'email', 'membership_type', 'join_date', 'status'
    ];
}
