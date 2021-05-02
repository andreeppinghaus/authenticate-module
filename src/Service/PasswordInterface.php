<?php

namespace src\Service;

interface PasswordInterface
{
    public function authenticate(string $email="", string $password);
    public function validate(string $password);
    public function generatePassword();
    public function generateToken();
}


?>