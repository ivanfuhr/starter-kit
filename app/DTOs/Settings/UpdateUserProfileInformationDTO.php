<?php

declare(strict_types = 1);

namespace App\DTOs\Settings;

final readonly class UpdateUserProfileInformationDTO
{
    public function __construct(
        public string $name,
        public string $email
    ) {
    }
}
