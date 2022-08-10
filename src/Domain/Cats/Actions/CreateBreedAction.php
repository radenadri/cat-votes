<?php

namespace Domain\Cats\Actions;

use Domain\Cats\DataTransferObjects\BreedData;
use Domain\Cats\Models\Breed;

class CreateBreedAction
{
    public function execute(BreedData $breedData)
    {
        Breed::insert([
            'name' => $breedData->name,
            'description' => $breedData->description,
            'is_active' => $breedData->is_active,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
