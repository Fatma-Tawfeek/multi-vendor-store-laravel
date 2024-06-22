<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail', 'database', 'broadcast'];

        $channels = ['database'];

        if ($notifiable->notification_prefrence['order_created']['sms'] ?? false) {
            $channels[] = 'vonage';
        }
        if ($notifiable->notification_prefrence['order_created']['mail'] ?? false) {
            $channels[] = 'mail';
        }
        if ($notifiable->notification_prefrence['order_created']['broadcast'] ?? false) {
            $channels[] = 'broadcast';
        }

        return $channels;
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $addr = $this->order->billingAddress;
        return (new MailMessage)
            ->subject('New Order #' . $this->order->number)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('Order #' . $this->order->number . ' has been created by ' . $addr->name . 'from ' . $addr->country_name)
            ->line('The introduction to the notification.')
            ->action('View Order', url('/dashboard'))
            ->line('Thank you for using our application!')
            // ->view('emails.order_created', ['order' => $this->order])
        ;
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'body' => 'New Order #' . $this->order->number . ' has been created by ' . $this->order->billingAddress->name . 'from ' . $this->order->billingAddress->country_name,
            'icon' => 'fas fa-shopping-cart',
            'url' => url('/dashboard')
        ];
    }

    public function toBroadcast(object $notifiable): array
    {
        return [
            'body' => 'New Order #' . $this->order->number . ' has been created by ' . $this->order->billingAddress->name . 'from ' . $this->order->billingAddress->country_name,
            'icon' => 'fas fa-shopping-cart',
            'url' => url('/dashboard')
        ];
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
