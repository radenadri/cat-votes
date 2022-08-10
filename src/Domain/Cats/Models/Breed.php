<?php

namespace Domain\Cats\Models;

use Domain\Cats\Collections\BreedCollection;
use Domain\Cats\QueryBuilders\BreedQueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name',
        'description',
        'is_active',
    ];

    public function newEloquentBuilder($query) : BreedQueryBuilder
    {
        return new BreedQueryBuilder($query);
    }

    public function newCollection(array $models = [])
    {
        return new BreedCollection($models);
    }

    public function cats()
    {
        return $this->hasMany(Cat::class);
    }
}
