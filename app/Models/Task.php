<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = 'tasks';
    protected $primaryKey = 'task_id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'task_id',
        'title',
        'description',
        'due_date',
        'status',
        'catigory_id',
        'user_id',
    ];
    public function catigory(): BelongsTo
    {
        return $this->belongsTo(Catigory::class, 'catigory_id');
    }
}
