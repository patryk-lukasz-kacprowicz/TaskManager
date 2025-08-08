<?php

namespace App\DTOs\Users;

use Spatie\DataTransferObject\DataTransferObject;

class UpdateUserDTO extends DataTransferObject
{
    /** @var string  */
    public string $name;

    /** @var string  */
    public string $email;

    /** @var string|null  */
    public ?string $password;
}
