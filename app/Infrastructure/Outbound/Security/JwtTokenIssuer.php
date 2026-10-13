<?php

namespace App\Infrastructure\Outbound\Security;

use App\Application\Ports\Outbound\TokenIssuer;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

final class JwtTokenIssuer implements TokenIssuer
{
    private string $secretKey;
    private int $ttl;

    public function __construct()
    {
        $this->secretKey = config('jwt.secret');
        $this->ttl = config('jwt.ttl', 28800);
    }

    public function issue(array $payload): string
    {
        $now = time();
        
        $payload = array_merge($payload, [
            'iat' => $now,
            'exp' => $now + $this->ttl,
            'iss' => config('app.url'),
            'aud' => config('app.name'),
        ]);

        return JWT::encode($payload, $this->secretKey, 'HS256');
    }

    public function decode(string $token): array
    {
        return (array) JWT::decode($token, new Key($this->secretKey, 'HS256'));
    }

    public function validate(string $token): bool
    {
        try {
            $this->decode($token);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}