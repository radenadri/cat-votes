<?php

namespace Domain\Cats\Actions;

use Domain\Cats\DataTransferObjects\CatData;
use Domain\Cats\Models\Cat;
use Illuminate\Support\Facades\Storage;

class UpdateCatAction
{
    public function execute(Cat $cat, CatData $catData)
    {
        $cat->name = $catData->name;
        $cat->description = $catData->description;
        $cat->is_active = $catData->is_active;
        $cat->breed_id = $catData->breed_id;
        if ($catData->avatar) {
            Storage::delete('uploads/' . $cat->avatar);

            $avatar = $catData->avatar;
            $avatarName = $avatar->hashName(); // Generate a unique, random name...

            $avatar->storePubliclyAs('uploads', $avatarName, config('filesystems.default'));
            $cat->avatar = $avatarName;
        }
        $cat->save();

    }
}
