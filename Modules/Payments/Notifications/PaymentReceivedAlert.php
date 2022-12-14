<?php

namespace Modules\Payments\Notifications;

use App\Channels\ShoutoutMessage;
use App\Services\WhatsappMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Payments\Entities\Payment;
use NotificationChannels\AwsPinpoint\AwsPinpointSmsMessage;
use NotificationChannels\Messagebird\MessagebirdMessage;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Twilio\TwilioSmsMessage;

class PaymentReceivedAlert extends Notification implements ShouldQueue
{
    use Queueable;

    public $payment;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Payment $payment)
    {
        $this->payment = $payment;
        $this->type = 'payment_received_alert';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($notifiable->notificationActive($this->type)) {
            return $notifiable->notifyOn($this->type, ['slack', 'mail']);
        }
        return [];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($notifiable->channelActive('mail', $this->type)) {
            return (new MailMessage())
                ->from(get_option('company_email'), get_option('company_name'))
                ->greeting(langmail('payments.received.greeting', ['name' => $notifiable->name]))
                ->subject(langmail('payments.received.subject'))
                ->line(langmail('payments.received.body', ['amount' => $this->payment->amount_formatted, 'date' => dateTimeFormatted($this->payment->payment_date), 'code' => $this->payment->invoice->reference_no]))
                ->action(langapp('view') . ' ' . langapp('invoice'), route('invoices.view', $this->payment->invoice->id))
                ->line(langmail('payments.received.footer'));
        }
    }

    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage())
                ->success()
                ->content(
                    langmail(
                        'payments.received.body',
                        [
                            'amount' => $this->payment->amount_formatted,
                            'date' => dateTimeFormatted($this->payment->payment_date),
                            'code' => $this->payment->invoice->reference_no,
                        ]
                    )
                )
                ->attachment(
                    function ($attachment) {
                        $attachment->title($this->payment->code, route('payments.view', $this->payment->id))
                            ->fields(
                                [
                                    langapp('company') => $this->payment->company->name,
                                    langapp('payment_method') => $this->payment->paymentMethod->method_name,
                                    langapp('invoice') => $this->payment->invoice->reference_no,
                                    langapp('amount') => $this->payment->amount_formatted,
                                ]
                            );
                    }
                );
        }
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        if ($notifiable->channelActive('database', $this->type)) {
            return [
                'subject' => langmail('payments.received.subject'),
                'icon' => 'money-check-alt',
                'activity' => langmail(
                    'payments.received.body',
                    [
                        'amount' => $this->payment->amount_formatted,
                        'date' => dateTimeFormatted($this->payment->payment_date),
                        'code' => $this->payment->invoice->reference_no,
                    ]
                ),
            ];
        }
    }

    /**
     * Get the Nexmo / SMS representation of the notification.
     *
     * @param  mixed $notifiable
     * @return NexmoMessage
     */
    public function toNexmo($notifiable)
    {
        if ($notifiable->channelActive('sms', $this->type)) {
            return (new NexmoMessage())
                ->content(
                    langmail('payments.received.body', [
                        'amount' => $this->payment->amount_formatted,
                        'date' => dateTimeFormatted($this->payment->payment_date),
                        'code' => $this->payment->invoice->reference_no,
                    ])
                );
        }
    }

    /**
     * Send message via WhatsApp
     */
    public function toWhatsapp($notifiable)
    {
        if ($notifiable->channelActive('whatsapp', $this->type)) {
            return WhatsappMessage::create()
                ->to($notifiable->mobile)
                ->custom($this->payment->id)
                ->message(
                    langmail('payments.received.body', [
                        'amount' => $this->payment->amount_formatted,
                        'date' => dateTimeFormatted($this->payment->payment_date),
                        'code' => $this->payment->invoice->reference_no,
                    ])
                );
        }
    }

    /**
     * Send message via Twilio
     */
    public function toTwilio($notifiable)
    {
        if ($notifiable->channelActive('sms', $this->type)) {
            return (new TwilioSmsMessage())
                ->content(
                    langmail('payments.received.body', [
                        'amount' => $this->payment->amount_formatted,
                        'date' => dateTimeFormatted($this->payment->payment_date),
                        'code' => $this->payment->invoice->reference_no,
                    ])
                );
        }
    }
    /**
     * Send SMS via AWS Pinpoint.
     *
     * @param \Modules\Users\Entities\User $notifiable
     * @return \NotificationChannels\AwsPinpoint\AwsPinpointSmsMessage
     */
    public function toAwsPinpoint($notifiable)
    {
        if ($notifiable->channelActive('sms', $this->type)) {
            return (new AwsPinpointSmsMessage(
                langmail('payments.received.body', [
                    'amount' => $this->payment->amount_formatted,
                    'date' => dateTimeFormatted($this->payment->payment_date),
                    'code' => $this->payment->invoice->reference_no,
                ])
            ));
        }
    }

    /**
     * Send SMS via Messagebird
     *
     * @param \Modules\Users\Entities\User $notifiable
     * @return NotificationChannels\Messagebird\MessagebirdMessage;
     */

    public function toMessagebird($notifiable)
    {
        if ($notifiable->channelActive('sms', $this->type)) {
            if (!is_null($notifiable->profile->mobile)) {
                return (new MessagebirdMessage(
                    langmail('payments.received.body', [
                        'amount' => $this->payment->amount_formatted,
                        'date' => dateTimeFormatted($this->payment->payment_date),
                        'code' => $this->payment->invoice->reference_no,
                    ])
                ));
            }
        } else {
            return (new MessagebirdMessage())->setRecipients([]);
        }
    }
    /**
     * Undocumented function
     *
     * @param [type] $notifiable
     * @return void
     */
    public function toShoutout($notifiable)
    {
        if ($notifiable->channelActive('sms', $this->type)) {
            if (!is_null($notifiable->profile->mobile)) {
                return (new ShoutoutMessage(
                    langmail('payments.received.body', [
                        'amount' => $this->payment->amount_formatted,
                        'date' => dateTimeFormatted($this->payment->payment_date),
                        'code' => $this->payment->invoice->reference_no,
                    ])
                ));
            }
        }
    }

    public function toTelegram($notifiable)
    {
        if ($notifiable->channelActive('telegram', $this->type)) {
            return TelegramMessage::create()
                ->content(
                    langmail('payments.received.body', [
                        'amount' => $this->payment->amount_formatted,
                        'date' => dateTimeFormatted($this->payment->payment_date),
                        'code' => $this->payment->invoice->reference_no,
                    ])
                )
                ->button('View Payment', route('payments.view', [$this->payment->id]));
        }
    }
}
