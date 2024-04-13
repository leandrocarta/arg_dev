<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CotizacionAereosNotification extends Notification
{
    use Queueable;

    protected $aereoData;
    public function __construct($aereoData)
    {
        $this->aereoData = $aereoData;
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
        return (new MailMessage)
        ->subject('Nueva Solicitud')
        ->greeting('Cotización de Aéreos !!!')
        ->line('Fecha de ida: ' . $this->aereoData['fecha_ida'])
        ->line('Fecha de regreso: ' . $this->aereoData['fecha_regreso'])
        ->line('Origen: ' . $this->aereoData['origen'])
        ->line('Destino: ' . $this->aereoData['destino'])
        ->line('Cantidad de adultos: ' . $this->aereoData['adultos'])
        ->line('Cantidad de menores: ' . $this->aereoData['menores'])
        ->line('Correo electrónico: ' . $this->aereoData['email'])
        ->line('Aclaración: ' . $this->aereoData['aclaracion'])
        ->line('Estado: ' . $this->aereoData['estado']);        
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
