<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

use App\User;

class AppNotification extends Notification
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
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [

            'data' => 'this is first'

        ];
    }


    public static function sendNotify($user_id,$web_msg,$mob_msg,$type,$web_url,$web_route)
    {
        $user = User::find($user_id);
        $user->notify(new AppNotification);
        
        $url = 'https://fcm.googleapis.com/fcm/send';
        $fields = array (
            'to' => "/topics/" .$user_id,
            'data' => array (
                "web_msg" => $web_msg,
                "mob_msg" => $mob_msg,
                "type" => $type,
                "web_url" => $web_url,
                "web_route" => $web_route
            )
        );
        $fields = json_encode ( $fields );
        $headers = array (
                'Authorization: key=' . "AAAAOKZ-G_o:APA91bFzQNtD1YuE6QQzeEkGNjdy2hFlar2Xoka-SazPEwofFQcJ1_zmYu-pOmpeO9JHnQNq6JU1aiWq-ocrrkDI95MOfS656hfyyijPggVqpZ8EMA5Atxj0JT6EHim4h73ydYb9GtR87sQ0ru9TTDreebLhviMFWw",
                'Content-Type: application/json'
        );
        
        $ch = curl_init ();
        curl_setopt ( $ch, CURLOPT_URL, $url );
        curl_setopt ( $ch, CURLOPT_POST, true );
        curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );
        
        $result = curl_exec ( $ch );
        curl_close ( $ch );
    }
}
