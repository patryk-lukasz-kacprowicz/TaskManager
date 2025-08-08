<?php

namespace App\Services;

use App\DTOs\Users\StoreUserDTO;
use App\DTOs\Users\UpdateUserDTO;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param StoreUserDTO $storeUserDTO
     *
     * @return bool
     */
    public function store(StoreUserDTO $storeUserDTO): bool {
        $newUser = User::query()
            ->create($storeUserDTO->toArray());

        if ($newUser) {
            return true;
        }

        return false;
    }

    /**
     * @param UpdateUserDTO $updateUserDTO
     * @param User $user
     *
     * @return bool
     */
    public function update(UpdateUserDTO $updateUserDTO, User $user): bool {
        $data = $updateUserDTO->toArray();

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        try {
            $user->update($data);
            $user->refresh();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }

    public function destroy(User $user): bool {
        try {
            $user->delete();

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
