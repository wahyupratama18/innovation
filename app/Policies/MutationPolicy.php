<?php

namespace App\Policies;

use App\Models\Mutation;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MutationPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Mutation $mutation)
    {
        //
    }

    private function validTeller(User $user, Mutation $mutation): bool
    {
        return $user->role == 2 && $mutation->user_id == $user->id;
    }

    public function viewDeposit(User $user, Mutation $mutation): bool
    {
        return $this->validTeller($user, $mutation) && $mutation->type == 0;
    }


    public function viewAMT(User $user, Mutation $mutation): bool
    {
        return $this->validTeller($user, $mutation) && $mutation->type == 1;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Mutation $mutation)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Mutation $mutation)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Mutation $mutation)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Mutation  $mutation
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Mutation $mutation)
    {
        //
    }
}
