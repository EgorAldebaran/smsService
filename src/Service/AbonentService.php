<?php  

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\SmsSender;
use App\Service\AbonentServiceInterface;

abstract class AbonentService implements AbonentServiceInterface
{
    private AbonentServiceInterface $abonentService;
    
    private $sender;
    private $reciever;
    
    public function __construct(AbonentServiceInterface $abonentService)
    {
        $this->abonentService = $abonentService;
    }

    public function handleRequest(?Request $httpData)
    {
        $choiceForm = "caller";
        $sender = $httpData->request->all()[$choiceForm]["sender"];
        $reciever = $httpData->request->all()[$choiceForm]["reciever"];
     
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

        } catch (\Exception $e) {
            echo "Ошибка: ". $e->getMessage();
        }
    }

}
