<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     *  id (auto-increment, primary key)
     * title (string, required)
     * description (text, optional)
     * status (enum: pending , in_progress , completed , default: pending )
     * due_date (date, optional)
     * created_at & updated_at (timestamps)
     */

    protected $fillable = [
        'id',
        'title',
        'description',
        'status',
        'due_date',
        'created_at',
    ];
}
