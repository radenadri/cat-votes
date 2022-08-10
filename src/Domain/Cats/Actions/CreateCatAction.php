<?php

namespace Domain\Cats\Actions;

use Domain\Cats\DataTransferObjects\CatData;
use Domain\Cats\Models\Cat;

class CreateCatAction
{
    public function execute(CatData $catData)
    {
        if ($catData->avatar) {
            $avatar = $catData->avatar;
            $avatarName = $avatar->hashName(); // Generate a unique, random name...

            $avatar->storePubliclyAs('uploads', $avatarName, config('filesystems.default'));
        }

        Cat::insert([
            'name' => $catData->name,
            'description' => $catData->description,
            'is_active' => $catData->is_active,
            'avatar' => $avatarName ?? null,
            'breed_id' => $catData->breed_id,
            'user_id' => auth()->id(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
