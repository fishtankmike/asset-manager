<?php

namespace App\Policies;

use App\AssetFile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetFilePolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can download the given asset file.
     *
     * @param  User  $user
     * @param  Asset  $task
     * @return bool
     */
    public function download(User $user, AssetFile $assetFile)
    {
        // Prevent restricted Users from downloading Asset File
        if (in_array($user->id, $assetFile->asset->users()->lists('user_id')->toArray())) {
            return false;
        }

        return $user->region === $assetFile->asset->region;
    }
}
