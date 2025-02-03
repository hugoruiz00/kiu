<?php

namespace App\Models;

use App\Enums\QueueStatusEnum;
use Illuminate\Database\Eloquent\Model;

class QueueEntry extends Model
{
    protected $fillable = [
        'position',
        'code',
        'estimated_service_time',
        'status',
        'business_id',
        'queue_client_id',
    ];

    public function business(){
        return $this->belongsTo(Business::class);
    }
    
    public function queue_client(){
        return $this->belongsTo(QueueClient::class);
    }

    public function getPositionNumberAttribute(){
        return QueueEntry::where('business_id', $this->business_id)
            ->where(['status' => QueueStatusEnum::ACTIVE])
            ->where('position', '<', $this->position)
            ->count() + 1;
    }
}
