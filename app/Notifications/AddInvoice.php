<?php

namespace App\Notifications;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;



class AddInvoice extends Notification
{
    use Queueable;

    private $invoiceId;

    public function __construct($invoiceId)
    {
        $this->invoiceId = $invoiceId;

    }


    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = 'http://127.0.0.1:8000/InvoiceDetails/' . $this->invoiceId;
        return (new MailMessage)
                    ->greeting('Welcome to our App')
                    ->subject('New Invoice Added')
                    ->line('New Invoice Added')
                    ->action('Show Invoice', $url)
                    ->line('Thank you for using our application!');
    }



    public function toArray($notifiable)
    {
        return [];
    }
}
