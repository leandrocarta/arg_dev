<?php

namespace App\Notifications;

use Illuminate\Support\Facades\URL;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailClient extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct($id)
    {
        $this->id = $id;
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

    public function toMail(object $notifiable): MailMessage
    {
        $url = URL::temporarySignedRoute(
            'verify.email.client',
            now()->addMinutes(60),
            ['id' => $this->id, 'hash' => sha1($notifiable->getEmailForVerification())]
        );

        return (new MailMessage)
            ->subject('Confirma tu dirección de correo electrónico')
            ->greeting('¡Bienvenidos Viajeros!')
            ->line('"Estás a punto de emprender un emocionante viaje lleno de descubrimientos y aventuras. Cada destino es una nueva historia por contar, cada experiencia es un recuerdo que atesorarás para siempre. Prepárate para vivir momentos inolvidables y sumergirte en la belleza del mundo que te espera. ¡Tu aventura comienza aquí!"')
            ->line('Por favor, haz clic en el siguiente botón para verificar tu dirección de correo electrónico.')
            ->action('Verificar Email', $url)
            ->line('Si no creaste una cuenta, no es necesario realizar ninguna acción.')
            ->salutation('¡Saludos, El Equipo de Argtravels');
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
