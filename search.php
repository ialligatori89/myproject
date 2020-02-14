<?php
/*//Создание тестового файла размером 10гб
$fp = fopen('test.txt', 'w+b');
for ($index = 1; $index <= 250000000; $index++) {
    $text = "ключ{$index}\tзначение{$index}\x0A"; // Исходная строка
    $write = fwrite($fp, $text); // Запись в файл
}
if ($write) {
    echo 'Данные в файл успешно занесены.';
}
else {
    echo 'Ошибка при записи в файл.';
}
fclose($fp);*/

$s = microtime(true);

function binarySearch($filename, $key)
{

$start = 0;
$end = filesize($filename);

    while ($start < $end) {
        $middle = $start + floor(($end - $start) / 2);
        $lines = explode("\x0A", file_get_contents($filename, FALSE, NULL, $middle, 4000));
        $params = [];
        foreach ($lines as $line) {
            $params[] = explode("\t", $line);
        }

        $result = array_filter($params, function($innerArray) use ($key) {
            return ($innerArray[0] == $key); //Поиск по первому значению
        });

        if ($result) {
            foreach ($result as $value) {
                return print_r($value[1]);
            }
        } else {
            $strnatcmp = strnatcmp($params[1][0], $key);
        }

        if ($strnatcmp > 0) {
            $end = $middle - 1;
        } elseif ($strnatcmp < 0) {
            $start = $middle + 1;
        }
    }
echo 'undef';

}
binarySearch('test.txt', "ключ2");

echo "\nВремя выполнения скрипта: " . round(microtime(true) - $s, 4) . ' сек.';