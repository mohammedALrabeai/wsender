<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Device extends Model
{
    use HasFactory;
    protected $fillable = [
        'nickname',
        'profile_id',
        'webhook_url',
        'user_id',
        'status',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Subscriptions
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Relationship with Campaigns
    public function campaigns()
    {
        return $this->hasMany(Campaign::class);
    }

    // Relationship with ChatBot
    public function chatBots()
    {
        return $this->hasMany(ChatBot::class);
    }



    protected static function booted()
{
    static::addGlobalScope('current_user_devices', function (Builder $builder) {
        $builder->where('user_id', auth()->id());
    });
}
}
