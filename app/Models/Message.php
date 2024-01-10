<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'group_id',
        'text',
        'user'
    ];

    public function group(): HasOne
    {
        return $this->hasOne(GroupOfMessages::class, 'id', 'group_id');
    }
}
