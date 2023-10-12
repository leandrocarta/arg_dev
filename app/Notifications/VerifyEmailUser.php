<?php

namespace App\Notifications;

use Illuminate\Support\Facades\URL;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyEmailUser extends Notification
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

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = URL::temporarySignedRoute(
            'verify.email.user',
            now()->addMinutes(60),
            ['id' => $this->id, 'hash' => sha1($notifiable->getEmailForVerification())]
        );

        return (new MailMessage)
            ->subject('Confirma tu dirección de correo electrónico')
            ->greeting('¡Bienvenidos Emprendedores!!')
            ->line('"Estás a punto de embarcarte en un emocionante viaje lleno de oportunidades y logros. Cada paso que des te acercará más a alcanzar tus metas y a experimentar un éxito sin igual. Prepárate para vivir momentos inolvidables mientras avanzas en tu camino hacia el éxito financiero. Tu aventura como emprendedor digital comienza aquí."')
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
