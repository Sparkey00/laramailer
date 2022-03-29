<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\Models\Recipient;
use App\Models\Sender;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class SendMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $message = Message::query()->first();
        $senders = Sender::all();

        /** @var Sender $sender */
        foreach ($senders as $sender) {
            for ($i=0; $i<10; $i++) {
                $recipients = Recipient::where('email_sent', false)->limit(50)->get();
                $mail = new PHPMailer();
                $usedMails = [];

                $mail->SMTPDebug = SMTP::DEBUG_SERVER;
                $mail->isSMTP();
                $mail->Host = "smtp.gmail.com";
                $mail->SMTPAuth = true;

                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port = 465;
                $mail->CharSet = 'UTF-8';
                $mail->Username = $sender->email;
                $mail->Password = $sender->password;
                $mail->From = $sender->email;
                $mail->FromName = "Украина";

                foreach ($recipients as $recipient) {
                    $mail->addAddress($recipient->email);
                    $usedMails[] = $recipient->id;
                }

                $mail->Subject = $message->subject;
                $mail->Body = $message->body;
                if (!$mail->send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    DB::table('recipients')->whereIn('id', $usedMails)->update(['email_sent' => true]);
                    echo "Message has been sent successfully";
                }
                sleep(1);
            }

        }
        return 0;
    }
}
