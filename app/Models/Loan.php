<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 
        'book_id', 
        'borrow_date', 
        'due_date', 
        'return_date', 
        'fine', 
        'returned'
    ];

    // Relasi ke Buku
    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    // Relasi ke Member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Menghitung denda otomatis berdasarkan tanggal pengembalian
    public function getFineAttribute()
    {
        if ($this->return_date && Carbon::parse($this->return_date)->gt(Carbon::parse($this->due_date))) {
            $daysLate = Carbon::parse($this->return_date)->diffInDays(Carbon::parse($this->due_date));
            return $daysLate * 1000; // Contoh denda Rp 1000 per hari
        }
        return 0;
    }
}
