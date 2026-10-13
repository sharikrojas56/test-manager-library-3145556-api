<?php

namespace App\Application\Services;

use App\Application\Ports\Outbound\PasswordHasher;
use App\Application\Ports\Outbound\TokenIssuer;
use App\Application\Ports\Outbound\UserRepository;

final class LoginService
{
    public function __construct(
        private UserRepository $userRepository,
        private PasswordHasher $passwordHasher,
        private TokenIssuer $tokenIssuer,
    ) {}

    public function execute(string $username, string $password): array
    {
        $user = $this->userRepository->findByUsername($username);
        
        if (!$user || !$this->passwordHasher->verify($password, $user->passwordHash())) {
            throw new \DomainException('Invalid credentials', 401);
        }
        
        $token = $this->tokenIssuer->issue([
            'sub' => $user->id(),
            'role' => $user->role(),
        ]);
        
        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => 28800, // 8 hours
            'role' => $user->role(),
        ];
    }
}