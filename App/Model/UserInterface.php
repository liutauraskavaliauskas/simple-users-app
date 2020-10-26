<?php

namespace App\Model;

interface UserInterface
{
    public function getEmail(): ?string;

    public function getPassword(): ?string;
}
