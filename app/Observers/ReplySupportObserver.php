<?php

namespace App\Observers;

use App\Models\ReplySupport;
use Illuminate\Support\Str;

class ReplySupportObserver
{
    /**
     * Handle the ReplySupport "creating" event.
     *
     * @param  \App\Models\ReplySupport  $replySupport
     * @return void
     */
    public function creating(ReplySupport $replySupport) // antes de criar uma resposta
    {
        //$replySupport->admin_id = auth()->user()-id;
        $replySupport->id = Str::uuid();
    }
}
