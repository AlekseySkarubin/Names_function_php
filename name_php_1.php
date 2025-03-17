<?php

// Функция для объединения фамилии, имени и отчества в одну строку
function getFullnameFromParts($surname, $name, $patronymic) {
    return $surname . ' ' . $name . ' ' . $patronymic;
}

// Функция для разбиения полной строки ФИО на части: фамилию, имя и отчество
function getPartsFromFullname($fullname) {
    // Разбиваем строку по пробелам
    $parts = explode(' ', $fullname);

    // Возвращаем ассоциативный массив с ключами 'surname', 'name' и 'patronymic'
    return [
        'surname' => $parts[0],
        'name' => $parts[1],
        'patronymic' => $parts[2],
    ];
}

// Пример использования функций
$fullname = 'Иванов Иван Иванович';
$parts = getPartsFromFullname($fullname);
echo 'Разделенное ФИО: ';
print_r($parts);

$combinedFullname = getFullnameFromParts('Иванов', 'Иван', 'Иванович');
echo 'Объединенное ФИО: ' . $combinedFullname;