<?php

namespace App\Policies;

use App\Models\TableSchema;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TableSchemaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, TableSchema $tableSchema): bool
    {
        return $user->id === $tableSchema->user_id;
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
    public function update(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, TableSchema $tableSchema): bool
    {
        return $user->id === $tableSchema->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, TableSchema $tableSchema): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, TableSchema $tableSchema): bool
    {
        return false;
    }
}
