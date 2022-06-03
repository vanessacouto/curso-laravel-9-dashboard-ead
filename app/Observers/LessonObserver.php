<?php

namespace App\Observers;

use App\Models\Lesson;
use Illuminate\Support\Str;

class LessonObserver
{
    /**
     * Handle the Lesson "creating" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function creating(Lesson $lesson) // antes de criar um Lesson
    {
        $lesson->id = Str::uuid();
        $lesson->url = Str::slug($lesson->name);
    }

      /**
     * Handle the Lesson "updating" event.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return void
     */
    public function updating(Lesson $lesson) // antes de atualizar um Lesson, atualiza a url a partir do name
    {
        $lesson->url = Str::slug($lesson->name);
    }
}
