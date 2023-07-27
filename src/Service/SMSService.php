<?php  

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\SmsSender;
use App\Service\AbonentServiceInterface;

class SMSService extends AbonentService implements AbonentServiceInterface
{ 
    private SmsSender $smsSender;
    private $message;
    
    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    
    /*
     * Сервис отправки сообщений
     */
    public function sendSMS(SmsSender $smsSender, EntityManagerInterface $entityManager): void
    {
        $smsSender->setSender($this->sender);
        $smsSender->setReciever($this->reciever);
        $smsSender->setMessage($this->message);
        $entityManager->persist($smsSender);
        $entityManager->flush();
    }
}
