<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class TicketMessage extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id','ticket_id','user_id','message_txt'];

    protected $with = ['media','user:id,name,role'];


    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
