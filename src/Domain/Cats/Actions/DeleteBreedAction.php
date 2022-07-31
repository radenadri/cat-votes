<?php

namespace Domain\Cats\Actions;

use Domain\Cats\Models\Breed;

class DeleteBreedAction
{
    public $breed;

    public function __construct(Breed $breed)
    {
        $this->breed = $breed;
    }

    public function execute()
    {
        $this->breed->delete();
    }
}
