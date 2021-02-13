<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactResponseMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    
    //  هنا هنعمل بابلك للفورم بتاع الايميل الجاى علشان نستخدمها دينامك داتا ف فورم الرد على الرسائل
    public $name, $title, $body;

    public function __construct($name, $title, $body)
    {
        $this->name = $name;
        $this->title = $title;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // دى للرد ع  الرسائل الكونتاكت ف الصفحه اللى عملاناها
    public function build()
    {
        return $this->view('emails.contact-response');
    }
}
