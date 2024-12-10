<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class DisneyNotification extends Notification
{
    use Queueable;

    protected $paqueteData;

    
    public function __construct($paqueteData)
    {
        $this->paqueteData = $paqueteData;
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
        ->subject('Nueva Solicitud')
        ->greeting('Consulta de Disney!!!')
        ->line('Nombre: ' . $this->paqueteData['name'])  
        ->line('Email: ' . $this->paqueteData['email'])  
        ->line('Destino Elegido: ' . $this->paqueteData['disney'])  
        ->line('Fecha de salida: ' . $this->paqueteData['fecha'])  
        ->line('Método de contacto: ' . $this->paqueteData['contacto'])  
        ->line('Número de móvil: ' . $this->paqueteData['movil'])  
        ->line('Comentario adicional: ' . $this->paqueteData['comentario'])  
        ->line('Promotor de ventas: ' . $this->paqueteData['promotor_ventas']);  

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