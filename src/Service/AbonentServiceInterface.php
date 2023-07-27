<?php  

namespace App\Service;

/*
 * общий интерфейс для всех будущих сервисов
 *
 */
interface AbonentServiceInterface
{
    /*
     * метод обрабатывает http запрос
     */
    public function handleRequest(?Request $request);
    
}
