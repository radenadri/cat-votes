<?php

namespace Domain\Cats\Actions;

use Domain\Cats\DataTransferObjects\BreedData;
use Domain\Cats\Models\Breed;

class CreateBreedAction
{
    public $breedData;

    public function __construct(BreedData $breedData)
    {
        $this->breedData = $breedData;
    }

    public function execute()
    {
        Breed::insert([
            'name' => $this->breedData->name,
            'description' => $this->breedData->description,
            'is_active' => $this->breedData->is_active,
        ]);
    }
}
