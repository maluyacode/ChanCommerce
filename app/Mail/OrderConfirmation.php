<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\PDF;

class OrderConfirmation extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $email;

    public function __construct($userEmail, $order)
    {
        $this->email = $userEmail;

        $this->order = $order;
    }

    public function build()
    {

        // var_dump(app(PDF::class));

        $pdf = app(PDF::class);
        $view = view('pdf.order', ['order' => $this->order]);
        $pdf->loadHTML($view->render());
        $pdf->setOptions(['defaultFont' => 'Arial']);

        // return $this->view('emails.order-confirmation')
        //             ->with(['order' => $this->order])
        //             ->attachData($pdf->output(), 'order.pdf', [
        //                 'mime' => 'application/pdf',
        //             ]);

        return $this->to($this->email)
            ->view('emails.order-confirmation')
            ->with(['order' => $this->order])
            ->attachData($pdf->output(), 'order.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the message envelope.
     */
}
