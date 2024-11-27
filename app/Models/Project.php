<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Project extends Model
{
    use Searchable;

    protected $fillable = [
        'name',
        'full_name',
        'owner',
        'description',
        'url',
        'html_url',
        'user_id',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the indexable data array for the model.
     *
     * @return array<string, mixed>
     */
    public function toSearchableArray(): array
    {
        return array_merge($this->toArray(), [
            'id' => (string) $this->id,
            'name' => $this->name,
            'full_name' => $this->full_name,
            'owner' => $this->owner,
            'description' => $this->description,
            'url' => $this->url,
            'html_url' => $this->html_url,
            'created_at' => $this->created_at->timestamp,
        ]);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pullRequests(): HasMany
    {
        return $this->hasMany(PullRequest::class);
    }

    public function commits(): HasMany
    {
        return $this->hasMany(Commit::class);
    }
}
