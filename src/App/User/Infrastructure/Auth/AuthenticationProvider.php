<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Auth;

use App\User\Domain\ValueObject\Auth\HashedPassword;
use App\User\Domain\ValueObject\Email;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Ramsey\Uuid\UuidInterface;

final class AuthenticationProvider
{
    public function __construct(private readonly JWTTokenManagerInterface $JWTManager)
    {
    }

    public function generateToken(UuidInterface $uuid, Email $email, HashedPassword $hashedPassword): string
    {
        $auth = Auth::create($uuid, $email, $hashedPassword);

        return $this->JWTManager->create($auth);
    }
}
