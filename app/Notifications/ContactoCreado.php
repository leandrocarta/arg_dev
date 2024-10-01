<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ContactoCreado extends Notification
{
    use Queueable;

    protected $contactoData;
    /**
     * Create a new notification instance.
     */
    public function __construct($contactoData)
    {
        $this->contactoData = $contactoData;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)                    
                    ->subject('Nuevo Contacto Creado')
                    ->greeting('Hola!')
                    ->line('Se ha creado un nuevo contacto.')
                    ->line('Nombre: ' . $this->contactoData['nombre'])
                    ->line('Apellido: ' . $this->contactoData['apellido'])
                    ->line('Le interesa: ' . $this->contactoData['tipo_producto'])
                    ->line('Correo Electrónico: ' . $this->contactoData['correo'])
                    ->line('Teléfono: ' . $this->contactoData['tel'])
                    ->line('Comentario: ' . $this->contactoData['comentario'])
                  //  ->action('Ver Contacto', url('/contactos/' . $this->contacto->id))
                    ->line('Gracias por utilizar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
