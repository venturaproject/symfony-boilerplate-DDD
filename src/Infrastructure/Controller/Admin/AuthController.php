<?php

namespace App\Infrastructure\Controller\Admin;
// src/Infrastructure/Controller/Admin/AuthController.php


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Form\Extension\Core\Type\SubmitType; // Importa el tipo de campo Submit

class AuthController extends AbstractController
{
    #[Route('/admin/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        // Obtén el último error de autenticación (si lo hay)
        $error = $authenticationUtils->getLastAuthenticationError();

        // Último nombre de usuario introducido por el usuario
        $lastUsername = $authenticationUtils->getLastUsername();

        // Crea el formulario de inicio de sesión usando Symfony Forms
        $form = $this->createFormBuilder()
            ->add('username', null, [
                'attr' => ['class' => 'form-control mb-3', 'placeholder' => 'Username'],
            ])
            ->add('password', null, [
                'attr' => ['class' => 'form-control mb-3', 'placeholder' => 'Password'],
            ])
            ->add('login', SubmitType::class, [
                'label' => 'Login',
                'attr' => ['class' => 'btn btn-primary btn-block'],
            ])
            ->getForm();

        // Manejo de envío del formulario
        $form->handleRequest($request);

        // Si el formulario se ha enviado y es válido
        if ($form->isSubmitted() && $form->isValid()) {
            // Aquí deberías manejar la autenticación del usuario
            // Puedes usar Symfony Security para manejar el proceso de autenticación
            // y redirigir al usuario al área administrativa una vez autenticado.
        }

        // Renderiza la vista Twig con el formulario y los datos necesarios
        return $this->render('admin/auth/login.html.twig', [
            'form' => $form->createView(), // Pasa el formulario a la plantilla Twig
            'error' => $error,
            'last_username' => $lastUsername,
        ]);
    }

    #[Route('/admin/logout', name: 'app_logout')]
    public function logout()
    {
        // Este método no necesita implementación, Symfony maneja el cierre de sesión automáticamente
    }
}
