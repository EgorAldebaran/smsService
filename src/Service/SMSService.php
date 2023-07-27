<?php  

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\SmsSender;

class SMSService
{
    private SmsSender $smsSender;
    private ?string $from = null;
    private ?string $to = null;
    private ?string $message = null;
    
    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    public function handleRequest(Request $request): void
    {
        try {
            
            if ($request->get('sender') !== null) {
                $this->from = $request->request->get('sender');
            } throw new \Exception('Значение Отправителя должно быть указано');

            if ($request->get('reciever') !== null) {
                $this->to = $request->request->get('reciever');
            } throw new \Exception('Значение Получателя должно быть указано');

            if ($request->get('message') !== null) {
                $this->message = $request->request->get('message');                
            } throw new \Exception('Сообщение не должно быть пустым');
            
        } catch (\Exception $e) {
            echo "Ошибка: ". $e->getMessage();
        }
    }

    /*
     * Сервис отправки сообщений
     */
    public function sendSMS(SmsSender $smsSender, EntityManagerInterface $entityManager): void
    {
        $smsSender->setReciever($this->to);
        $smsSender->setMessage($this->message);
        $entityManager->persist($this->smsSender);
        $entityManager->flush();
    }
}
