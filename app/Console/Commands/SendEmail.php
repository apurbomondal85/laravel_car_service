<?php

namespace App\Console\Commands;

use App\Mail\BulkEmail;
use App\Models\EmailRecipient;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to users';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $recipients = EmailRecipient::with('subscriber')->where(['try' => 0])->limit(50)->get();

        if (count($recipients) > 0) {
            foreach ($recipients as $recipient) {
                try {
                    Mail::to($recipient->subscriber->email)->send(new BulkEmail($recipient->subscriber->name, $recipient->email->subject, $recipient->email->message));

                    $recipient->update(['try' => 1,'is_sent' => 1]);
                } catch (\Exception $e) {
                    logger($e->getMessage());
                    $recipient->update(['try' => 1]);
                }
            }
        }
    }
}
