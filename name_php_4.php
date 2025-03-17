<?php
// Исходный массив данных
$example_persons_array = [ 
    [
        'fullname' => 'Иванов Иван Иванович',
        'job' => 'tester',
    ]
    [
        'fullname' => 'Степанова Наталья Степановна',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Пащенко Владимир Александрович',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Громов Александр Иванович',
        'job' => 'fullstack-developer',
    ],
    [
        'fullname' => 'Славин Семён Сергеевич',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Цой Владимир Антонович',
        'job' => 'frontend-developer',
    ],
    [
        'fullname' => 'Быстрая Юлия Сергеевна',
        'job' => 'PR-manager',
    ],
    [
        'fullname' => 'Шматко Антонина Сергеевна',
        'job' => 'HR-manager',
    ],
    [
        'fullname' => 'аль-Хорезми Мухаммад ибн-Муса',
        'job' => 'analyst',
    ],
    [
        'fullname' => 'Бардо Жаклин Фёдоровна',
        'job' => 'android-developer',
    ],
    [
        'fullname' => 'Шварцнегер Арнольд Густавович',
        'job' => 'babysitter',
    ],
];
// Функция раскладки строки с ФИО на отдельные элементы массива
function getPartsFromFullname($fullname) {
    $parts = explode(' ', $fullname);
    return [
        'surname' => $parts[0],
        'name' => $parts[1],
        'patronymic' => $parts[2],
    ];
}
// Функция определния пола по данным ФИО
function getGenderFromName($fullname) {
    $parts = getPartsFromFullname($fullname);
    $genderScore = 0;

    if (mb_substr($parts['patronymic'], -3) === 'вна') {
        $genderScore -= 1;
    }
    if (mb_substr($parts['name'], -1) === 'а') {
        $genderScore -= 1;
    }
    if (mb_substr($parts['surname'], -2) === 'ва') {
        $genderScore -= 1;
    }

    if (mb_substr($parts['patronymic'], -2) === 'ич') {
        $genderScore += 1;
    }
    if (mb_substr($parts['name'], -1) === 'й' || mb_substr($parts['name'], -1) === 'н') {
        $genderScore += 1;
    }
    if (mb_substr($parts['surname'], -1) === 'в') {
        $genderScore += 1;
    }

    if ($genderScore > 0) {
        return 1;
    } elseif ($genderScore < 0) {
        return -1;
    } else {
        return 0;
    }
}
// Функция определния возрастного состава по исходному массиву даннных $example_persons_array
function getGenderDescription($personsArray) {
    $totalPersons = count($personsArray);

    $males = array_filter($personsArray, function($person) {
        return getGenderFromName($person['fullname']) === 1;
    });

    $females = array_filter($personsArray, function($person) {
        return getGenderFromName($person['fullname']) === -1;
    });

    $undefined = array_filter($personsArray, function($person) {
        return getGenderFromName($person['fullname']) === 0;
    });

    $maleCount = count($males);
    $femaleCount = count($females);
    $undefinedCount = count($undefined);

    $malePercentage = round(($maleCount / $totalPersons) * 100, 1);
    $femalePercentage = round(($femaleCount / $totalPersons) * 100, 1);
    $undefinedPercentage = round(($undefinedCount / $totalPersons) * 100, 1);

    return "Гендерный состав аудитории:\n" .
           "---------------------------\n" .
           "Мужчины - $malePercentage%\n" .
           "Женщины - $femalePercentage%\n" .
           "Не удалось определить - $undefinedPercentage%\n";
}

echo getGenderDescription($example_persons_array);