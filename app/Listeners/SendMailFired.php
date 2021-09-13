<?php

namespace App\Listeners;

use App\Events\SendMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Mailable;
use App\Mail\OrderShipped;

class SendMailFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {  
                
       
        $details = [
            'id' => $event->id->id,
            'category_id' => $event->id->category_id,
            'name' => $event->id->name,
            'description' => $event->id->description,
            'created_at' => $event->id->created_at
        ];
        $user['to']='applocumadmin@yopmail.com';

        // \Mail::to('ajaykantkanojiy@gmail.com')->send(new \App\Mail\MyTestMail($details));
            // \Mail::to('ajaykantkanojiy@gmail.com')->send(new OrderShipped($details));
            // dd("Email is Sent.");
            \Mail::send('products.shipped',$details, function($message) use ($user){
                   $message->to($user['to']);
                   $message->subject('Hello dev');

            });
       

        // $to_name = ‘RECEIVER_NAME’;
        //     $to_email = ‘ajaykantkanojiya@gmail.com’;
        //     $data = array(‘name’=>”Ogbonna Vitalis(sender_name)”, “body” => “A test mail”);
        //     Mail::send(‘emails.mail’, $data, function($message) use ($to_name, $to_email) {
        //     $message->to($to_email, $to_name)
        //     ->subject(Laravel Test Mail’);
        //     $message->from(‘SENDER_EMAIL_ADDRESS’,’Test Mail’);
        //     });
    }
}
