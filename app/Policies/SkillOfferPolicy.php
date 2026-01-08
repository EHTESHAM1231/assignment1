<?php

namespace App\Policies;

use App\Models\SkillOffer;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SkillOfferPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(?User $user): bool
    {
        return true; // Anyone can view skill offers
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(?User $user, SkillOffer $skillOffer): bool
    {
        return true; // Anyone can view individual skill offers
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true; // Any authenticated user can create skill offers
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, SkillOffer $skillOffer): bool
    {
        return $user->id === $skillOffer->user_id; // Only the owner can update
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, SkillOffer $skillOffer): bool
    {
        return $user->id === $skillOffer->user_id; // Only the owner can delete
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, SkillOffer $skillOffer): bool
    {
        return $user->id === $skillOffer->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, SkillOffer $skillOffer): bool
    {
        return $user->id === $skillOffer->user_id;
    }
}
