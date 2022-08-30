<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserRegisteredEmail extends Mailable
{
    /*
     Queueable - Envio de emails em fila
    */
    use Queueable, SerializesModels;

    private $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            //assunto
            ->subject('Conta Criada com Sucesso!')
            //responder a
            ->replyTo(env('MAIL_REPLY_TO_ADDRESS'))
            ->view('emails.user-registered')
            //uso de atributo privado
            ->with(['user' => $this->user]);
    }
}
