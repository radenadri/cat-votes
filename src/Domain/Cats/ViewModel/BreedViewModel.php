<?php

namespace Domain\Cats\ViewModel;

use Domain\Cats\Models\Breed;
use Spatie\ViewModels\ViewModel;

class BreedViewModel extends ViewModel
{
    public $breed;
    public $url;

    public function __construct(Breed $breed = null, string $url = null)
    {
        $this->breed = $breed;
        $this->url = $url;
    }

    public function breed(): Breed
    {
        return $this->breed() ?? new Breed();
    }
}
