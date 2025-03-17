<?php

// Функция для разбиения полной строки ФИО на части: фамилию, имя и отчество
function getPartsFromFullname($fullname) {
    $parts = explode(' ', $fullname);
    return [
        'surname' => $parts[0],
        'name' => $parts[1],
        'patronymic' => $parts[2],
    ];
}

// Функция для определения пола по ФИО
function getGenderFromName($fullname) {
    // Разбиваем ФИО на составные части
    $parts = getPartsFromFullname($fullname);

    // Инициализируем суммарный признак пола
    $genderScore = 0;

    // Проверяем признаки женского пола
    // Отчество заканчивается на "вна"
    if (mb__substr($parts['patronymic'], -3) === 'вна') {
        $genderScore -= 1;
    }
    // Имя заканчивается на "а"
    if (mb__substr($parts['name'], -1) === 'а') {
        $genderScore -= 1;
    }
    // Фамилия заканчивается на "ва"
    if (mb__substr($parts['surname'], -2) === 'ва') {
        $genderScore -= 1;
    }

    // Проверяем признаки мужского пола
    // Отчество заканчивается на "ич"
    if (mb__substr($parts['patronymic'], -2) === 'ич') {
        $genderScore += 1;
    }
    // Имя заканчивается на "й" или "н"
    if (mb__substr($parts['name'], -1) === 'й' || mb__substr($parts['name'], -1) === 'н') {
        $genderScore += 1;
    }
    // Фамилия заканчивается на "в"
    if (mb__substr($parts['surname'], -1) === 'в') {
        $genderScore += 1;
    }

    // Определяем результат на основе суммарного признака пола
    if ($genderScore > 0) {
        return 1; // Мужской пол
    } elseif ($genderScore < 0) {
        return -1; // Женский пол
    } else {
        return 0; // Неопределенный пол
    }
}

// Запрос ввода ФИО у пользователя
$surname = readline("Введите фамилию: ");
$name = readline("Введите имя: ");
$patronymic = readline("Введите отчество: ");

// Формируем полное ФИО
$fullname = $surname . ' ' . $name . ' ' . $patronymic;

// Определяем пол
$gender = getGenderFromName($fullname);

// Выводим результат
echo 'Пол: ' . ($gender === 1 ? 'Мужской' : ($gender === -1 ? 'Женский' : 'Неопределенный')) . PHP__EOL;