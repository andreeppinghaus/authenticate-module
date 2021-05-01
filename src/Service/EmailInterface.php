<?php

namespace src\Service;

interface EmailInterface
{
    public function setEmail(string $email);
    public function getEmail(): string;
    public function send();
}


?>