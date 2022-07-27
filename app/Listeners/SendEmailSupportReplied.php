<?php

namespace App\Listeners;

use App\Models\ReplySupport;
use App\Events\SupportReplied;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmailSupportReplied as MailSendMailSupportReplied;;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailSupportReplied
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(
        public ReplySupport $replySupport
    )
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\SupportReplied  $event
     * @return void
     */
    public function handle(SupportReplied $event)
    {
        // aqui temos acesso a todos os dados da resposta do support
        $replySupport = $event->getReplySupport();
        $support = $replySupport->support;

        // usuario que abriu o support
        $user = $support->user;

        Mail::to($user->email)
                ->send(new MailSendMailSupportReplied($replySupport));
    }
}
