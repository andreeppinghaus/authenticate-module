<?php

namespace src\Service;

require_once __DIR__."/../../autoload.php";

require_once "bootstrap.php";


use Exception;
use src\Entity\User;

class AuthenticateManager {
    private $passwordService;
    private $emailService;
    private $entityManager;

    function __construct($entityManager)
    {
        $this->passwordService = new PasswordService();
        $this->emailService = new EmailService();
        $this->entityManager = $entityManager;
    }

    public function createAccount(string $email, string $password ) : bool{
        $new = false;

        try {
            $this->emailService->setEmail($email) ;

            if ( $this->passwordService->validate($password) ) {
                $hash = $this->passwordService->generatePassword($password);
    
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($hash);
                $this->entityManager->persist($user);
                $this->entityManager->flush();
    
                $new = true;
    
            }

        }catch (Exception $error){
            echo $error->getMessage();

        }
        
       

        return $new;

    }

    public function authenticate(string $email, string $password) : bool {
        $logou = false;
        $user = $this->entityManager->getRepository(User::class)
                    ->findBy(['email'=>$email ]);

        // var_dump($user);
        if (! empty($user)) {
            $logou = $this->passwordService->authenticate($user[0]->getPassword(), $password);
        }

        return $logou;
    }

}

?>