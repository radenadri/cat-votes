<?php

namespace Domain\Cats\ViewModel;

use App\Admin\Cats\Resources\BreedResource;
use Domain\Cats\Models\Breed;
use Domain\Cats\Models\Cat;
use Spatie\ViewModels\ViewModel;

class CatViewModel extends ViewModel
{
    public $cat;

    public $url;

    public $breed;

    public function __construct(Cat $cat = null, string $url = null)
    {
        $this->cat = $cat;
        $this->url = $url;
        $this->breed = Breed::latest()->get()->map(fn ($breed) => new BreedResource($breed));
    }

    public function cat(): Cat
    {
        return $this->cat() ?? new Cat();
    }
}
