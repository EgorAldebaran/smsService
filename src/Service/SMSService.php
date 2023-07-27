<?php  

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\SmsSender;
use App\Service\AbonentServiceInterface;

class SMSService implements AbonentServiceInterface
{
    private SmsSender $smsSender;
    private $sender;
    private $reciever;
    private $message;
    
    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    public function handleRequest($httpData, $choiceForm)
    {
        
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
