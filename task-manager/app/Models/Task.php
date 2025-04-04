<?php

namespace App\Models;

//use Dotenv\Util\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use function Pest\Laravel\from;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Task extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     *  id (auto-increment, primary key)
     * title (string, required)
     * description (text, optional)
     * status (enum: pending , in_progress , completed , default: pending )
     * due_date (date, optional)
     * created_at & updated_at (timestamps)
     */

    protected $fillable = [
//        'id',
        'title',
        'description',
        'status',
        'due_date',
//        'created_at',
    ];

    public static function create(array $array)
    {
    }

}
