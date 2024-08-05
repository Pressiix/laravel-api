<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'content',
        'created_by',
    ];

    /**
     * Get the user that created the post.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}