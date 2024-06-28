<?php

namespace App\Infrastructure\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class EmailService
{
    private $mailer;
    private $testEmail;

    public function __construct(MailerInterface $mailer, string $testEmail)
    {
        $this->mailer = $mailer;
        $this->testEmail = $testEmail;
    }

    public function sendTestEmail(string $to): void
    {
        if ($this->testEmail == 1) {
            $email = (new Email())
                ->from('sender@example.com')
                ->to($to)
                ->subject('Test Email')
                ->text('This is a test email.')
                ->html('<p>This is a test email.</p>');

            $this->mailer->send($email);
        }
    }
}