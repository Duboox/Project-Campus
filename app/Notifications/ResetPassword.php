<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPassword extends Notification
{
    use Queueable;
    
    public $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Recuperación de Contraseña')
            ->greeting('Hola, en este correo podrás recuperar tu contraseña.')
            ->line('Da click en el enlance para Recuperar')
            ->action('Recuperar contraseña', route('password.reset', $this->token))
            ->line('Si no realizaste esta solicitud, ignora este mensaje.')
            ->salutation('Saludos, de parte del equipo '. config('app.name'));
    }
}
