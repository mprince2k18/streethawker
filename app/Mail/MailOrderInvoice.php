<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailOrderInvoice extends Mailable
{
    use Queueable, SerializesModels;

    public $cartToMail = '';
    public $order_idToMail = '';
    public $userNameToMail = '';
    public $addressToMail = '';
    public $emailToMail = '';
    public $phoneToMail = '';
    public $orderNoteToMail = '';
    public $paymentTypeToMail = '';
    public $shipToMail = '';
    public $subToMail = '';
    public $totToMail = '';
    public $dataToMail = '';
    public $orderTrackingId = '';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(
      $cartToMail,
      $order_idToMail,
      $userNameToMail,
      $addressToMail,
      $emailToMail,
      $phoneToMail,
      $orderNoteToMail,
      $paymentTypeToMail,
      $shipToMail,
      $subToMail,
      $totToMail,
      $dataToMail,
      $orderTrackingId
      )
    {
      $this->cartToMail = $cartToMail;
      $this->order_idToMail = $order_idToMail;
      $this->userNameToMail = $userNameToMail;
      $this->addressToMail = $addressToMail;
      $this->emailToMail = $emailToMail;
      $this->phoneToMail = $phoneToMail;
      $this->orderNoteToMail = $orderNoteToMail;
      $this->paymentTypeToMail = $paymentTypeToMail;
      $this->shipToMail = $shipToMail;
      $this->subToMail = $subToMail;
      $this->totToMail = $totToMail;
      $this->dataToMail = $dataToMail;
      $this->orderTrackingId = $orderTrackingId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       $cartToMail = '';
       $order_idToMail = '';
       $userNameToMail = '';
       $addressToMail = '';
       $emailToMail = '';
       $phoneToMail = '';
       $orderNoteToMail = '';
       $paymentTypeToMail = '';
       $shipToMail = '';
       $subToMail = '';
       $totToMail = '';
       $dataToMail = '';
       $orderTrackingId = '';
        return $this->from('shawkerbd@gmail.com','Street Hawker')
                ->subject('Street hawker order invoice')
                ->view('OrderInvoice',compact(
                  'cartToMail',
                  'order_idToMail',
                  'userNameToMail',
                  'addressToMail',
                  'emailToMail',
                  'phoneToMail',
                  'orderNoteToMail',
                  'paymentTypeToMail',
                  'shipToMail',
                  'subToMail',
                  'totToMail',
                  'dataToMail',
                  'orderTrackingId'
                ));
    }
}
