<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

/**
 * Email de confirmación de compra
 * Se envía cuando se completa un pedido
 */
class PurchaseConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $order;
    public $cart;

    public function __construct($user, $order, $cart)
    {
        $this->user = $user;
        $this->order = $order;
        $this->cart = $cart;
    }

    /**
     * Asunto y detalles del email
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '✅ Tu compra ha sido confirmada - Ondori',
        );
    }

    /**
     * Vista a renderizar
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.purchase-confirmation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
