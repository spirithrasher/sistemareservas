<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NuevaReserva extends Mailable
{
    use Queueable, SerializesModels;
    protected $reserva;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($reserva)
    {
        $this->reserva = $reserva;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->view('emails.nuevareserva')
            ->subject( "Nueva Reserva")
            ->with([
                "reserva" => $this->reserva
            ]);
    }
}
