<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pending extends Model
{
    use HasFactory;


    protected $table = 'pending';


    protected $fillable = [
        'item_id', 'quantity', 'description'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
