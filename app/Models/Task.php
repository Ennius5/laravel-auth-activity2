<?php


namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Task extends Model
{
    /**
     * The attributes that can be mass assigned.
     */
    protected $fillable = ['user_id', 'title'];

    /**
     * Get the user that owns this task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
