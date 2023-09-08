<?php
ini_set('max_execution_time', 500);

use Test\AmoCRM_Wrap\Token;
use Test\AmoCRM_Wrap\AmoCRM;
use Test\AmoCRM_Wrap\Lead;

require_once __DIR__ .'/autoload.php';

$authData = array(
    'client_id'     => 'f7cfb09c-e17b-4de8-abec-4ef10b114235',
    'client_secret' => '3I7DWEfEJaU2siXcwig4Tckzj7C7cKIebVQmd0WChiY8txpJbRmCLXpI7zXBD0Bk',
    'redirect_uri'  => 'https://test.com',
    'domain'        => 'kovalevantonrabota'
);

try {
    $amo = new AmoCRM($authData['domain'], new Token($authData));

    //Генерация номеров
    $generatePhoneList = generatePhoneList();
    //Генерация email
    $generateEmailList = generateEmailList();

    for($j = 0; $j < 80; $j++){ 

        $contactList = array();

        for($i = 0; $i < 250; $i++){
            $name = ($j == 0) ? 'Контакт ' . $i + 1 : 'Контакт ' . $j * 250 + $i + 1; 
            $contactList[] = contact(
                $name, 
                $generatePhoneList[array_rand($generatePhoneList)],
                $generatePhoneList[array_rand($generatePhoneList)],  
                $generateEmailList[array_rand($generateEmailList)],
                $generateEmailList[array_rand($generateEmailList)]
            );
        }

        //Добавление контактов в аккаунт пакетно
        $contact = $amo->addContacts($contactList);
    }

    echo 'Success';
} catch (Exception $e) {
    echo "Ошибка в получении токена: {$e->getMessage()}";
}
