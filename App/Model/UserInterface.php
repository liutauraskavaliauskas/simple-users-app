<?php

namespace App\Model;

interface UserInterface
{
    public function getEmail(): ?string;

    public function getUserName(): ?string;

    public function getPassword(): ?string;
}
