<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ReclamoFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $cod_pais;
    public $movil;
    public $pais;
    public $comentario;
    /**
     * Create a new message instance.
     */
    public function __construct($id, $nombre, $apellido, $email, $cod_pais, $movil, $pais, $comentario)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->cod_pais = $cod_pais;
        $this->movil = $movil;
        $this->pais = $pais;
        $this->comentario = $comentario;
    }
    public function build()
    {
        $nombre = $this->nombre;
        $apellido = $this->apellido;
        $email = $this->email;
        $cod_pais = $this->cod_pais;
        $movil = $this->movil;
        $pais = $this->pais;
        $comentario = $this->comentario;

        $contenidoCorreo = "Nombre: $nombre\n";
        $contenidoCorreo = "Nombre: $apellido\n";
        $contenidoCorreo .= "Correo electrónico: $email\n";
        $contenidoCorreo = "Nombre: $cod_pais\n";
        $contenidoCorreo = "Nombre: $movil\n";
        $contenidoCorreo .= "País: $pais\n";
        $contenidoCorreo .= "Comentario:\n$comentario\n";

        if ($this->id && auth()->check()) {
            $id = $this->id;
            $contenidoCorreo .= "ID del cliente autenticado: $id\n";
        }

        return $this->text('mail.clients.reclamos_web') // Opcional: Usar texto sin formato en lugar de HTML.
            ->subject('Nuevo mensaje de contacto')
            ->with(['contenido' => $contenidoCorreo]);
    }
    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Reclamos Formulario Web',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.clients.reclamos_web',
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
