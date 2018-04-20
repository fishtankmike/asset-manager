<?php

namespace App\Policies;

use App\Asset;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AssetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine if the given user can view the given asset.
     *
     * @param  User  $user
     * @param  Asset  $task
     * @return bool
     */
    public function show(User $user, Asset $asset)
    {
        // Prevent restricted Users from viewing Asset
        if (in_array($user->id, $asset->users()->lists('user_id')->toArray())) {
            return false;
        }

        return $user->region === $asset->region;
    }
}
