<?php

namespace App\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Infrastructure\Service\EmailService;

class LuckyController extends AbstractController
{
    #[Route('/lucky/number', name: 'app_lucky_number')]
    public function number(EmailService $emailService): Response
    {
        $number = random_int(0, 100);

        $emailService->sendTestEmail('recipient5@example.com');

        return $this->render('lucky/number.html.twig', [
            'number' => $number,
        ]);
    }
}