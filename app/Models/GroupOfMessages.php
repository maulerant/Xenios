<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property Collection $messages
 * @property string $name
 */
class GroupOfMessages extends Model
{
    use HasFactory;

    public $timestamps = null;

    protected $fillable = [
        'name'
    ];

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'group_id');
    }

}
