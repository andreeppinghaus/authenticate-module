<?php

namespace src\Service;

interface PasswordInterface
{
    public function authenticate(string $hash, string $password);
    public function validate(string $password);
    public function generatePassword();
    public function generateToken();
}


?>