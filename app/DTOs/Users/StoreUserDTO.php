<?php

namespace App\DTOs\Users;

use Spatie\DataTransferObject\DataTransferObject;

class StoreUserDTO extends DataTransferObject
{
    /** @var string  */
    public string $name;

    /** @var string  */
    public string $email;

    /** @var string  */
    public string $password;
}
