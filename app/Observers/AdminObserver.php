<?php

namespace App\Observers;

use App\Models\Admin;
use Illuminate\Support\Str;

class AdminObserver
{
    /**
     * Handle the Admin "creating" event.
     *
     * @param  \App\Models\Admin  $user
     * @return void
     */
    public function creating(Admin $admin) // antes de criar um administrador
    {
        $admin->id = Str::uuid();
    }
}
