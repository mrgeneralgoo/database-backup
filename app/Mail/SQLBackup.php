<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SQLBackup extends Mailable
{
    use Queueable, SerializesModels;

    protected $backupResult = [];
    protected $attachList   = [];

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $backupResult = [], array $attachList = [])
    {
        $backupResult && $this->backupResult = $backupResult;
        $attachList && $this->attachList = $attachList;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        foreach ($this->attachList as $attach) {
            $this->attach($attach);
        }

        return $this->subject('SQL Backup Message')
            ->view('emails.notice')
            ->with('backupResult',$this->backupResult);
    }
}
