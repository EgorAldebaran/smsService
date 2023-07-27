<?php  

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\SmsSender;

class SMSService
{
    private SmsSender $smsSender;
    public $sender;
    public $reciever;
    public $message;
    
    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    public function handleRequest($httpData): void
    {
        $sender = $httpData->request->all()["sms"]["sender"];
        $reciever = $httpData->request->all()["sms"]["reciever"];
        $message = $httpData->request->all()["sms"]["message"];

        try {
            if ($sender !== null) {
                $this->sender = $sender;
            } else {
                throw new \Exception('Значение Отправителя должно быть указано');  
            } 

            if ($reciever !== null) {
                $this->reciever = $reciever;
            } else {
                throw new \Exception('Значение Получателя должно быть указано');
            }

            if ($message !== null) {
                $this->message = $message;
            } else {
                throw new \Exception('Сообщение не должно быть пустым');   
            }
            
        } catch (\Exception $e) {
            echo "Ошибка: ". $e->getMessage();
        }
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
