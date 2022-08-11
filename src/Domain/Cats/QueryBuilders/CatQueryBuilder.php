<?php

namespace Domain\Cats\QueryBuilders;

use Illuminate\Database\Eloquent\Builder;

class CatQueryBuilder extends Builder
{
    public function myself(): self
    {
        return $this->where('user_id', auth()->id());
    }
}
