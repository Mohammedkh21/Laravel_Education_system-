<?php

namespace App\Policies;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CoursePolicy
{
    function access($user,Course $course)
    {
        if ($user instanceof Student) {
            return $this->studentAccess($user, $course);
        }

        if ($user instanceof Teacher) {
            return $this->teacherAccess($user, $course);
        }

        return false;
    }
    private function studentAccess(Student $student, Course $course)
    {
        return $student->courses->contains($course->id)
            ? Response::allow()
            : Response::deny('You do not have permission to access on this course');

    }

    // Specific access logic for Teachers
    private function teacherAccess(Teacher $teacher, Course $course)
    {
        return $teacher->courses->contains($course->id)
            ? Response::allow()
            : Response::deny('You do not have permission to access on this course');
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
    public function view(Teacher $teacher, Course $course)
    {

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
    public function update(Teacher $teacher, Course $course)
    {

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Teacher $teacher, Course $course)
    {

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Course $course): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Course $course): bool
    {
        //
    }
}
