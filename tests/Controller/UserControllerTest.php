<?php

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

final class UserControllerTest extends WebTestCase
{
    public function testIndex(): void
    {
        $client = static::createClient();
        $client->request('GET', '/user');

        self::assertResponseIsSuccessful();
    }

    public function testRegister(): void
    {
        $client = static::createClient();

        $data = [
            'email' => 'test@example.com',
            'password' => 'password123'
        ];

        $client->request('POST', '/api/register', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));

        $response = $client->getResponse();

        $this->assertEquals(Response::HTTP_CREATED, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('User registered successfully!', $responseData['message']);
    }

    public function testLogin(): void
    {
        $client = static::createClient();

        // Création d'un utilisateur dans la base de données
        $entityManager = $client->getContainer()->get('doctrine')->getManager();
        $user = new \App\Entity\User();
        $user->setEmail('testlogin@example.com');
        $user->setPassword(
            $client->getContainer()->get('security.password_hasher')->hashPassword($user, 'password123')
        );
        $entityManager->persist($user);
        $entityManager->flush();

        // Données pour la connexion
        $data = [
            'email' => 'testlogin@example.com',
            'password' => 'password123'
        ];

        $client->request('POST', '/api/login', [], [], ['CONTENT_TYPE' => 'application/json'], json_encode($data));

        $response = $client->getResponse();

        // Vérifications
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Login successful!', $responseData['message']);
        $this->assertArrayHasKey('user', $responseData);
        $this->assertEquals('testlogin@example.com', $responseData['user']['email']);
    }

    public function testLogout(): void
    {
        $client = static::createClient();

        // Simule un utilisateur connecté
        $client->loginUser(
            $client->getContainer()->get('doctrine')->getRepository(\App\Entity\User::class)->findOneBy(['email' => 'testlogin@example.com'])
        );

        $client->request('POST', '/api/logout');

        $response = $client->getResponse();

        // Vérifications
        $this->assertEquals(Response::HTTP_OK, $response->getStatusCode());
        $responseData = json_decode($response->getContent(), true);
        $this->assertArrayHasKey('message', $responseData);
        $this->assertEquals('Logout successful.', $responseData['message']);
    }
}
