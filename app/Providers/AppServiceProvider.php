<?php

namespace App\Providers;

use App\Models\Camp;
use App\Models\Course;
use App\Models\Document;
use App\Models\Lecture;
use App\Models\Student;
use App\Models\Teacher;
use App\Observers\DocumentObserver;
use App\Policies\CampPolicy;
use App\Policies\CoursePolicy;
use App\Policies\StudentPolicy;
use App\Policies\TeacherPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Document::observe(DocumentObserver::class);
        Gate::policy(Course::class,CoursePolicy::class);
        Gate::policy(Teacher::class,TeacherPolicy::class);
        Gate::policy(Student::class,StudentPolicy::class);
        Gate::policy(Camp::class,CampPolicy::class);
    }
}
