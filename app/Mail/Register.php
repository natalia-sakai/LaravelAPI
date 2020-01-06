<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Register extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('natalia@brunolopes.com', 'CodeWise')
            ->subject('Registrar Ordem e Ágape')
            ->markdown('mails.registro')
            ->with([
                'link' => 'http://localhost:8100/admin'
            ]);
    }
}
