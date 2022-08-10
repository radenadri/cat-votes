<?php

namespace Domain\Cats\QueryBuilders;

use Domain\Cats\Enums\BreedStatusEnum;
use Illuminate\Database\Eloquent\Builder;

class BreedQueryBuilder extends Builder
{
    public function active(): self
    {
        return $this->where('is_active', BreedStatusEnum::ACTIVE);
    }
}
