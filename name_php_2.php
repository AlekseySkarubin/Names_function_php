<?php

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

// Функция для получения сокращенного имени
function getShortName($fullname) {
    // Получаем части полного имени
    $parts = getPartsFromFullname($fullname);

    // Формируем сокращенное имя: "Имя Ф."
    return $parts['name'] . ' ' . mb_substr($parts['surname'], 0, 1) . '.'; //mb_substr не работала не олайн-компиляторе, но работала функция substr()
}

// Выводим результат
$fullname = 'Иванов Иван Иванович';
$shortName = getShortName($fullname);
echo 'Сокращенное имя: ' . $shortName;  // Вывод: Иван И.