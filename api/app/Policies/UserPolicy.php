<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Roda antes de qualquer outro método. Se devolver true, libera geral;
     * se devolver null, segue pro método específico da ação.
     */
    public function before(User $user): ?bool
    {
        return $user->is_admin ? true : null;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, User $model): bool
    {
        return $user->id === $model->id;
    }

    /**
     * Determine whether the user can promote another user to admin.
     */
    public function promote(): bool
    {
        return false;
    }

    /**
     * Determine whether the user can demote another user.
     */
    public function lower(): bool
    {
        return false;
    }
}
