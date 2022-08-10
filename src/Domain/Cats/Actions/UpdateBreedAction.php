<?php

namespace Domain\Cats\Actions;

use Domain\Cats\DataTransferObjects\BreedData;
use Domain\Cats\Models\Breed;

class UpdateBreedAction
{
    public function execute(Breed $breed, BreedData $breedData)
    {
        $breed->name = $breedData->name;
        $breed->description = $breedData->description;
        $breed->is_active = $breedData->is_active;
        $breed->save();
    }
}
