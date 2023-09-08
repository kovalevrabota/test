<?php

/**
 * Вывод массива
 * @param $str
 */
function debug($str)
{
    echo "<pre>";
    print_r($str);
    echo "</pre>";
}

/**
 * Логирование
 * @param $data
 * @param string $title
 * @param null $name
 * @return false|int
 */
function writeToLog($data, $title = null, $name = null) {
    $log = "\n------------------------\n";
    $log .= date("d.m.Y G:i:s") . "\n";
    $log .= (strlen($title) > 0 ? $title : 'DEBUG') . "\n";
    $log .= print_r($data, 1);
    $log .= "\n------------------------\n";
    $path = __DIR__ . '/logs';
    $fileName = "{$name}_". date('Y-m');
    if (!mkdir($path, 0777, true) && !is_dir($path)) {
        $path = __DIR__;
    }
    return file_put_contents("{$path}/test_{$fileName}.log", $log, FILE_APPEND);
}

/**
 * Генерация номера
 * @param int $requiredLength
 * @param int $highestDigit
 * @return string
 */
function generatePhone($requiredLength = 9, $highestDigit = 9) {
    $sequence = '';
    for ($i = 0; $i < $requiredLength; ++$i) {
        $sequence .= mt_rand(0, $highestDigit);
    }
    return $sequence;
}

/**
 * Генерация номеров
 * @return array
 */
function generatePhoneList() {
    $listPhone = array();

    for ($i = 0; $i < 20; ++$i) {
        $listPhone[] = '89' . generatePhone();
    }

    return $listPhone;
}

/**
 * Генерация почты
 * @param int $username_length
 * @return string
 */
function generateEmail($username_length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $tld = array("com", "ru");

    $randomName = ''; 

    for($i=0; $i<$username_length; $i++){
        $randomName .= $characters[rand(0, strlen($characters) -1)];
    }

    $k = array_rand($tld); 
    $extension = $tld[$k]; 
    $email = $randomName . "@" ."test.".$extension; 

    return $email;
}

/**
 * Генерация почты
 * @return array
 */
function generateEmailList() {
    $listEmail = array();

    for ($i = 0; $i < 20; ++$i) {
        $listEmail[] = generateEmail(5);
    }

    return $listEmail;
}

/**
 * Создание контакта
 * @param string $name
 * @param string $phoneWork
 * @param string $phoneMob
 * @param string $emailWork
 * @param string $emailPriv
 * @return array
 */
function contact($name, $phoneWork, $phoneMob, $emailWork, $emailPriv) {
    $contact = array(
        'name' => $name,
        'custom_fields_values' => array(
            array(
                'field_code' => 'PHONE',
                'values' => array(
                    array(
                        'value' => $phoneWork,
                        'enum_code' => 'WORK'
                    )
                )
            ),
            array(
                'field_code' => 'PHONE',
                'values' => array(
                    array(
                        'value' => $phoneMob,
                        'enum_code' => 'MOB'
                    )
                )
            ),
            array(
                'field_code' => 'EMAIL',
                'values' => array(
                    array(
                        'value' => $emailWork,
                        'enum_code' => 'WORK'
                    )
                )
            ),
            array(
                'field_code' => 'EMAIL',
                'values' => array(
                    array(
                        'value' => $emailPriv,
                        'enum_code' => 'PRIV'
                    )
                )
            ),
        )
    );

    return $contact;
}