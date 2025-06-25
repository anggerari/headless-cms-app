<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Media extends Model
{
    use HasFactory;

    // Use 'media' as the table name explicitly if Laravel defaults to 'medias'
    protected $table = 'media';

    protected $fillable = [
        'user_id',
        'path',
        'name',
        'mime_type',
        'size',
    ];

    /**
     * Get the user that uploaded the media.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
