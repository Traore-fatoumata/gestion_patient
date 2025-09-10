<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class RendezVousStatusNotification extends Notification
{
    use Queueable;

    protected $rendezVous;

    public function __construct($rendezVous)
    {
        $this->rendezVous = $rendezVous;
    }

    public function via($notifiable)
    {
        return ['database', 'mail']; // notifications dans DB et email
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("Votre rendez-vous avec le Dr {$this->rendezVous->medecin->nom} a été {$this->rendezVous->statut}.")
                    ->action('Voir le rendez-vous', url('/patient/dashboard'));
    }

    public function toDatabase($notifiable)
    {
        return [
            'rendez_vous_id' => $this->rendezVous->id,
            'medecin' => $this->rendezVous->medecin->nom,
            'statut' => $this->rendezVous->statut,
            'message' => "Votre rendez-vous a été {$this->rendezVous->statut}."
        ];
    }
}
