<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;

class StoreReceiveNewOrder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [
            'database',
//            'sms',
//            'vonage',
//            'mail',
//            'nexmo'
        ];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Você recebeu um novo pedido!')
            ->greeting('Olá, vendedor! Tudo bem?')
            ->line('Você recebeu um novo pedido na loja!')
            ->action('Ver pedido', route('admin.orders.my'));
//            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $basic = new Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
        $client = new Client($basic);
        $response = $client->sms()->send(
            new SMS(env('VONAGE_TO'), env('APP_NAME'), 'Você recebeu um novo pedido em nosso site!')
        );

        return [
            'message' => 'Existe uma nova solicitação de pedido!'
        ];
    }

    public function toVonage($notifiable)
    {
        $basic = new Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));

        return (new Client($basic))
            ->sms()
            ->send(
                new SMS(env('VONAGE_TO'), env('APP_NAME'), 'Você recebeu um novo pedido em nosso site!')
            );
    }
}
