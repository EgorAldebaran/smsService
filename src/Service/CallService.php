<?php  

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Caller;
use App\Service\AbonentServiceInterface;
use App\Service\AbonentService;

class CallService extends AbonentService implements AbonentServiceInterface
{
    private Caller $caller;
    public function __construct(Caller $caller)
    {
        $this->caller = $caller;
    }

    /*
     * сервис звонков
     */
    public function startCall(Caller $caller, EntityManagerInterface $entityManager): void
    {
        $caller->setSender($this->sender);
        $caller->setReciever($this->reciever);
        $entityManager->persist($caller);
        $entityManager->flush();
    }
}
