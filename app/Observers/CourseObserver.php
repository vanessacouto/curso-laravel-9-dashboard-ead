<?php

namespace App\Observers;

use App\Models\Course;
use Illuminate\Support\Str;

class CourseObserver
{
      /**
     * Handle the Admin "creating" event.
     *
     * @param  \App\Models\Course  $user
     * @return void
     */
    public function creating(Course $course) // antes de criar um curso
    {
        $course->id = Str::uuid();
    }
}
