<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeacherPolicy
{
    function access(Admin $admin,Teacher $teacher)
    {
        return $admin->teachers()->contains($teacher->id)
            ? Response::allow()
            : Response::deny('You do not have permission to access on this teacher');
    }
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Teacher $teacher): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Teacher $teacher): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Teacher $teacher): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Teacher $teacher): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Teacher $teacher): bool
    {
        //
    }
}
