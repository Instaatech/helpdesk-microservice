<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Ticket extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['id', 'category_id', 'assigned_to_user_id', 'priority', 'title', 'description', 'is_closed', 'closed_date', 'open_by_user', 'closed_by_user'];

    protected $with = ['assignedTo:id,name','category:id,name','closedBy:id,name,role','openByUser:id,name,role'];

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function closedBy()
    {
        return $this->belongsTo(User::class, 'closed_by_user');
    }

    public function openByUser()
    {
        return $this->belongsTo(User::class, 'open_by_user');
    }

    public function messages()
    {
        return $this->hasMany(TicketMessage::class,'ticket_id','id');
    }


}
