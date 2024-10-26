<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerAddedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customerName;

    /**
     * Create a new message instance.
     *
     * @param string $customerName
     */
    public function __construct($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Customer Added Successfully')
                    ->view('emails.customer_added')
                    ->with(['customerName' => $this->customerName]);
    }
}