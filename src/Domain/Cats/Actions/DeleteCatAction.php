<?php

namespace Domain\Cats\Actions;

use Domain\Cats\Models\Cat;

class DeleteCatAction
{
    public function execute(Cat $cat)
    {
        $cat->delete();
    }
}
