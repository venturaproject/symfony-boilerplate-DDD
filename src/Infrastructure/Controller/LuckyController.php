<?php

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class LuckyController extends AbstractController
{
    #[Route('/lucky/number', name: 'app_lucky_number')]
    public function number(MailerInterface $mailer): Response
    {
        $number = random_int(0, 100);

        $appSecret = $_ENV['TEST_EMAIL'];

        if ($appSecret == 1) {

            $email = (new Email())
                ->from('sender@example.com')
                ->to('recipient5@example.com')
                ->subject('Test Email')
                ->text('This is a test email.')
                ->html('<p>This is a test email.</p>');


            $mailer->send($email);
        }


        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }
}