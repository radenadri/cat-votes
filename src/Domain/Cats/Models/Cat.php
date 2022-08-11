<?php

namespace Domain\Cats\Models;

use Domain\Cats\QueryBuilders\CatQueryBuilder;
use Domain\Users\Models\User;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use LaravelInteraction\Vote\Concerns\Voteable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Cat extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Voteable;

    protected $appends = ['avatar_path'];

    protected $guarded = [
        'id',
    ];

    public function newEloquentBuilder($query) : CatQueryBuilder
    {
        return new CatQueryBuilder($query);
    }

    public function breed()
    {
        return $this->belongsTo(Breed::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected function avatarPath(): Attribute
    {
        return new Attribute(
            get: fn () => $this->avatar ? asset('uploads/' . $this->avatar) : null,
        );
    }

    public function delete()
    {
        Storage::delete('uploads/' . $this->avatar);

        parent::delete();
    }
}
