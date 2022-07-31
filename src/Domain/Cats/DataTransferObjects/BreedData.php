<?php

namespace Domain\Cats\DataTransferObjects;

use App\Admin\Cats\Requests\BreedRequest;
use Spatie\DataTransferObject\DataTransferObject;

class BreedData extends DataTransferObject
{
    /** @var string */
    public $name;

    /** @var string */
    public $description;

    /** @var bool */
    public $is_active;

    public static function fromRequest(BreedRequest $request): self
    {
        return new self([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'is_active' => $request->get('is_active'),
        ]);
    }
}
