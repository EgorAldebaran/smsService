<?php  

namespace App\Service;

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
}
