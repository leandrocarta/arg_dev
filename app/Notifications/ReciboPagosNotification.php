<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReciboPagosNotification extends Notification
{
    use Queueable;

    protected $reciboPagos;

    /**
     * Create a new notification instance.
     */
    public function __construct($reciboPagos)
    {
        $this->reciboPagos = $reciboPagos;
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
         ->subject('Pago Realizado')
         ->greeting('Recibo de Pago')
         ->line('En la Ciudad de Funes, con fecha: ' . $this->reciboPagos['fecha'] . ',')
         ->line('Recibimos de ' . $this->reciboPagos['nombre'] . ' ' . $this->reciboPagos['apellido'] .
          ' DNI N°: ' . $this->reciboPagos['dni'] . ' la cantidad de ' . $this->reciboPagos['importe'] .
          ' ' .  $this->reciboPagos['moneda'] . ' en concepto de ' . $this->reciboPagos['concepto'])
          ->salutation('Saludos, Leandro Carta');
         
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
