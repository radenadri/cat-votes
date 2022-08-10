<?php

namespace Domain\Cats\DataTransferObjects;

use App\Admin\Cats\Requests\CatRequest;
use Spatie\DataTransferObject\DataTransferObject;

class CatData extends DataTransferObject
{
    /** @var string */
    public $name;

    /** @var string */
    public $description;

    /** @var bool */
    public $is_active;

    /** @var int */
    public $breed_id;

    /** @var object */
    public $avatar;

    public static function fromRequest(CatRequest $request): self
    {
        return new self([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'is_active' => $request->get('is_active'),
            'breed_id' => $request->get('breed_id'),
            'avatar' => $request->file('avatar'),
        ]);
    }
}
