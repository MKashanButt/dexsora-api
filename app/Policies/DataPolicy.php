<?php

namespace App\Policies;

use App\Models\User;
use App\Models\data;
use App\Models\TableSchema;
use Illuminate\Auth\Access\Response;

class DataPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, TableSchema $tableSchema): bool
    {
        return $user->id === $tableSchema->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, data $data): bool
    {
        return $user->id === $data->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, TableSchema $tableSchema): bool
    {
        return $user->id === $tableSchema->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, data $data): bool
    {
        return $user->id === $data->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, data $data): bool
    {
        return $user->id === $data->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, data $data): bool
    {
        return $user->id === $data->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, data $data): bool
    {
        return $user->id === $data->user_id;
    }
}
