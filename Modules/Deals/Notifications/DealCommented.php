<?php

namespace Modules\Deals\Notifications;

use App\Channels\ShoutoutMessage;
use App\Services\WhatsappMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\NexmoMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;
use Modules\Deals\Entities\Deal;
use NotificationChannels\AwsPinpoint\AwsPinpointSmsMessage;
use NotificationChannels\Messagebird\MessagebirdMessage;
use NotificationChannels\Telegram\TelegramMessage;
use NotificationChannels\Twilio\TwilioSmsMessage;

class DealCommented extends Notification implements ShouldQueue
{
    use Queueable;

    public $deal;
    public $type;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Deal $deal)
    {
        $this->deal = $deal;
        $this->type = 'deal_commented';
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
            return $notifiable->notifyOn($this->type, ['slack', 'database']);
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
                ->greeting(langmail('deals.commented.greeting', ['name' => $notifiable->name]))
                ->subject(langmail('deals.commented.subject', ['title' => $this->deal->title]))
                ->line(langmail('deals.commented.body', [
                    'title' => $this->deal->title,
                    'contact' => $this->deal->company->contact->name,
                ]))
                ->line('[View Deal](' . route('deals.view', $this->deal->id) . ')')
                ->line(langmail('deals.commented.footer'));
        }
    }
    public function toSlack($notifiable)
    {
        if ($notifiable->channelActive('slack', $this->type)) {
            return (new SlackMessage())
                ->content(
                    langmail(
                        'deals.commented.body',
                        [
                            'title' => $this->deal->title,
                            'contact' => $this->deal->company->contact->name,
                        ]
                    )
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
                'subject' => langmail('deals.commented.subject', ['title' => $this->deal->title]),
                'icon' => 'comments',
                'activity' => langmail(
                    'deals.commented.body',
                    [
                        'title' => $this->deal->title,
                        'contact' => $this->deal->company->contact->name,
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
                    langmail(
                        'deals.commented.body',
                        [
                            'title' => $this->deal->title,
                            'contact' => $this->deal->company->contact->name,
                        ]
                    )
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
                ->custom($this->deal->id)
                ->message(
                    langmail(
                        'deals.commented.body',
                        [
                            'title' => $this->deal->title,
                            'contact' => $this->deal->company->contact->name,
                        ]
                    )
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
                    langmail(
                        'deals.commented.body',
                        [
                            'title' => $this->deal->title,
                            'contact' => $this->deal->company->contact->name,
                        ]
                    )
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
            return (new AwsPinpointSmsMessage(langmail('deals.commented.body', [
                'title' => $this->deal->title,
                'contact' => $this->deal->company->contact->name,
            ])));
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
                    langmail('deals.commented.body', [
                        'title' => $this->deal->title,
                        'contact' => $this->deal->company->contact->name,
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
                    langmail('deals.commented.body', [
                        'title' => $this->deal->title,
                        'contact' => $this->deal->company->contact->name,
                    ])
                ));
            }
        }
    }

    public function toTelegram($notifiable)
    {
        if ($notifiable->channelActive('telegram', $this->type)) {
            return TelegramMessage::create()
                ->content(langmail('deals.commented.body', [
                    'title' => $this->deal->title,
                    'contact' => $this->deal->company->contact->name,
                ]))
                ->button('View Deal', route('deals.view', [$this->deal->id, 'comments']));
        }
    }
}
