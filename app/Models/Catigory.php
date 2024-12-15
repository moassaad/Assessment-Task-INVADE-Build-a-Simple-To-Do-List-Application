<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catigory extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'catigories';
    protected $primaryKey = 'catigory_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'catigory_id',
        'catigory_name',
        'color',
        'user_id',
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class,'task_id');
    }
}
