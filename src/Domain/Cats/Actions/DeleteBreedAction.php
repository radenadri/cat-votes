<?php

namespace Domain\Cats\Actions;

use Domain\Cats\Models\Breed;

class DeleteBreedAction
{
    public function execute(Breed $breed)
    {
        $breed->delete();
    }
}
