<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'phone_number',
        'estimated_service_time',
        'is_open',
        'user_id',
        'business_category_id'        
    ];

    public function business_category(){
        return $this->belongsTo(BusinessCategory::class);
    }

    public function queue_entries(){
        return $this->hasMany(QueueEntry::class);
    }
}
