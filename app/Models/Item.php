<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\User;

class Item extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('namaproduk', 'like', '%' . $search . '%')
                ->orWhere('harga', 'like', '%' . $search . '%');
        });
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function low()
    {
        return $this->hasMany(Low::class);
    }

    public function pending()
    {
        return $this->hasMany(Pending::class);
    }
}
    // public function User()
    // {
    //     return $this->belongsTo(User::class);
    // }
