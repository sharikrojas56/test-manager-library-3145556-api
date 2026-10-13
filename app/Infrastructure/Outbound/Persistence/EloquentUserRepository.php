<?php

namespace App\Infrastructure\Outbound\Persistence;

use App\Application\Ports\Outbound\UserRepository;
use App\Infrastructure\Outbound\Persistence\Models\User as UserModel;

class EloquentUserRepository implements UserRepository
{
    public function findByUsername(string $username): ?object
    {
        $user = UserModel::where('username', strtolower(trim($username)))->first();
        
        if (!$user) {
            return null;
        }
        
        return (object) [
            'id' => $user->id,
            'username' => $user->username,
            'passwordHash' => $user->password_hash,
            'role' => $user->role,
        ];
    }
    
    public function findById(string $id): ?object
    {
        $user = UserModel::find($id);
        
        if (!$user) {
            return null;
        }
        
        return (object) [
            'id' => $user->id,
            'username' => $user->username,
            'passwordHash' => $user->password_hash,
            'role' => $user->role,
        ];
    }
    
    public function save(object $user): void
    {
        UserModel::updateOrCreate(
            ['id' => $user->id],
            [
                'username' => strtolower(trim($user->username)),
                'password_hash' => $user->passwordHash,
                'role' => $user->role,
            ]
        );
    }
}