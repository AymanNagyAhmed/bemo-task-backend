<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "cards";

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'kanban_column_id',
    ];

    public function getStatusAttribute(): bool
    {
        if ($this->trashed()) {
            return false;
        }else if ($this->kanbanColumn->trashed()){
            return false;
        }
        return true;
    }

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];


    // relations

    public function kanbanColumn(): BelongsTo
    {
        return $this->belongsTo(KanbanColumn::class)->withTrashed();
    }


}
