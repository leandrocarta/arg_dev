<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $nombre;
    public $email;
    public $pais;
    public $comentario;

    public function __construct($id, $nombre, $email, $pais, $comentario)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->email = $email;
        $this->pais = $pais;
        $this->comentario = $comentario;
    }

    public function build()
    {
        $nombre = $this->nombre;
        $email = $this->email;
        $pais = $this->pais;
        $comentario = $this->comentario;

        $contenidoCorreo = "Nombre: $nombre\n";
        $contenidoCorreo .= "Correo electrónico: $email\n";
        $contenidoCorreo .= "País: $pais\n";
        $contenidoCorreo .= "Comentario:\n$comentario\n";

        if ($this->id && auth()->check()) {
            $id = $this->id;
            $contenidoCorreo .= "ID del cliente autenticado: $id\n";
        }

        return $this->text('mail.clients.contacto_web') // Opcional: Usar texto sin formato en lugar de HTML.
            ->subject('Nuevo mensaje de contacto')
            ->with(['contenido' => $contenidoCorreo]);
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Contacto Formulario Web',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.clients.contacto_web',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
