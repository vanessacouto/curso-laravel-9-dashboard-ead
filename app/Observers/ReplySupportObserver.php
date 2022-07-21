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
        $replySupport->user_id = '001054b8-aaa3-4f0d-b7a9-ec1274d838ef'; // deixou fixo para não dar erro por enquanto
        $replySupport->id = Str::uuid();
    }
}
