<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Camp;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CampPolicy
{
    function access($user, Camp $camp)
    {
        if ($user instanceof Admin) {
            return $this->adminAccess($user, $camp);
        }

        if ($user instanceof Teacher) {
            return $this->teacherAccess($user, $camp);
        }

        return false;
    }
    private function adminAccess(Admin $admin, Camp $camp)
    {

        return  $admin->camps()->where('camps.id', $camp->id)->first()
            ? Response::allow()
            : Response::deny('You do not have permission to access on this camp');
    }

    // Specific access logic for Teachers
    private function teacherAccess(Teacher $teacher, Camp $camp)
    {
        return  $teacher->camps()->where('camps.id', $camp->id)->first()
            ? Response::allow()
            : Response::deny('You do not have permission to access on this camp');
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
    public function view(User $user, Camp $camp): bool
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
    public function update(User $user, Camp $camp): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Camp $camp): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Camp $camp): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Camp $camp): bool
    {
        //
    }
}
