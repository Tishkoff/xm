<?php

namespace App\Mail;

use App\Xm\Company\Company;
use Carbon\CarbonInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class HistoryRequest extends Mailable
{
    use Queueable, SerializesModels;

    protected Company $company;
    public CarbonInterface $startDate;
    public CarbonInterface $endDate;

    /**
     * Create a new message instance.
     */
    public function __construct(Company $company, CarbonInterface $startDate, CarbonInterface $endDate)
    {
        $this->company = $company;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->company->getName(),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.history_request',
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
