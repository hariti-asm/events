<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable=['title','description','date_time','location','category_id','available_seats','approved', 'user_id','reservation_type','image','price'];

    public function organizer()
    {
        return $this->belongsTo(User::class,'user_id');
    }
     public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
  
