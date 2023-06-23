<?php

namespace App\Mail;

use App\Models\Jadwal;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ScheduledApprove extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $role;
    public $peminjaman;
    public $jadwal;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user, $role = null, Peminjaman $peminjaman = null, Jadwal $jadwal = null)
    {
        $this->user = $user;
        $this->role = $role;
        $this->peminjaman = $peminjaman;
        $this->jadwal = $jadwal;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Scheduled Approve',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */

    public function build()
    {
        $subject = 'New Schedule Created';

        return $this->subject($subject)
            ->view('emails.scheduleapprove')->with('peminjaman', $this->peminjaman)->with('jadwal', $this->jadwal);;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
