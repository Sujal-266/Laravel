<?php

namespace App\Mail;

use App\Models\Category;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CategoryCreatedMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * The category ID.
     *
     * @var int
     */
    public int $categoryId;

    /**
     * Create a new message instance.
     */
    public function __construct(int $categoryId)
    {
        $this->categoryId = $categoryId;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Category Created Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        try {
            $category = Category::find($this->categoryId);
            return new Content(
                view: 'emails.category_created',
                with: ['category' => $category]
            );
        } catch (\Throwable $th) {
            \App\Traits\ErrorManager::registerError(
                $th->getMessage(),
                __FILE__,
                $th->getLine(),
                $th->getFile()
            );
            // Optionally, return a fallback view or handle gracefully
            return new Content(
                view: 'emails.category_created',
                with: ['category' => null]
            );
        }
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
