<?php

namespace App\Policies;

use App\Models\Lecture;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class LecturePolicy
{
    function access(Teacher $teacher,Lecture $lecture)
    {
        return
            $teacher->courses()->with('lectures')->get()
                ->pluck('lectures')->flatten()->where('id', $lecture->id)->isNotEmpty()
            ? Response::allow()
            : Response::deny('You do not have permission to access on this lecture');
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
    public function view(User $user, Lecture $lecture): bool
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
    public function update(User $user, Lecture $lecture): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Lecture $lecture): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Lecture $lecture): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Lecture $lecture): bool
    {
        //
    }
}
