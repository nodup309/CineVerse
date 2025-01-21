<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Security\LoginFormAuthenticator;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): \Symfony\Component\HttpFoundation\Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/api/register', name: 'user_register', methods: ['POST'])]
    public function register(
        Request                     $request,
        UserPasswordHasherInterface $passwordHasher
    ): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['email']) || !isset($data['password'])) {
            return new JsonResponse(['message' => 'Email and password are required.'], JsonResponse::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setEmail($data['email']);
        $hashedPassword = $passwordHasher->hashPassword($user, $data['password']);
        $user->setPassword($hashedPassword);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        return new JsonResponse([
            'message' => 'User registered successfully!',
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
            ]
        ], JsonResponse::HTTP_CREATED);
    }

    #[Route('/api/login', name: 'user_login', methods: ['POST'])]
    public function login(
        #[CurrentUser] ?User       $user,
        UserAuthenticatorInterface $authenticator,
        LoginFormAuthenticator     $loginFormAuthenticator,
        Request                    $request
    ): JsonResponse
    {
        if (!$user) {
            return new JsonResponse(['message' => 'Invalid credentials.'], JsonResponse::HTTP_UNAUTHORIZED);
        }

        $authenticator->authenticateUser($user, $loginFormAuthenticator, $request);

        return new JsonResponse([
            'message' => 'Login successful!',
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
            ]
        ]);
    }

    #[Route('/api/logout', name: 'user_logout', methods: ['POST'])]
    public function logout(Request $request): JsonResponse
    {
        $session = $request->getSession();
        if ($session) {
            $session->invalidate();
        }

        return new JsonResponse(['message' => 'Logout successful.']);
    }
}
