<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\PDF;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;
    public $order;
    public $Email;
    public function __construct($Email, $order)
    {
        $this->Email = $Email;
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

        return $this->to($this->Email)
            ->view('emails.confirm-confirmation')
            ->with(['order' => $this->order])
            ->attachData($pdf->output(), 'confirm.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the message envelope.
     */
}
