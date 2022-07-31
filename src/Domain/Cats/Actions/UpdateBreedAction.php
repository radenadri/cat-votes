<?php

namespace Domain\Cats\Actions;

use Domain\Cats\DataTransferObjects\BreedData;
use Domain\Cats\Models\Breed;

class UpdateBreedAction
{
    public $breed;

    public $breedData;

    public function __construct(Breed $breed, BreedData $breedData)
    {
        $this->breed = $breed;
        $this->breedData = $breedData;
    }

    public function execute()
    {
        $this->breed->name = $this->breedData->name;
        $this->breed->description = $this->breedData->description;
        $this->breed->is_active = $this->breedData->is_active;
        $this->breed->save();
    }
}
