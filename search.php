<?php
/*
//Создание тестового файла размером 10гб
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
fclose($fp);
*/

$s = microtime(true);

function binarySearch($filename, $key)
{

$start = 0;
$end = filesize($filename);

    while ($start < $end) {
        $middle = $start + floor(($end - $start) / 2);
        $lines = explode("\x0A", file_get_contents($filename, FALSE, NULL, $middle, 4000));
        $index = explode("\t", $lines[1]);
        $strnatcmp = strnatcmp($index[0], $key);
        if ($strnatcmp === 0) {
            return print_r($index[1]);
        } elseif ($strnatcmp > 0) {
            $end = $middle - 1;
        } else {
            $start = $middle + 1;
        }
    }
echo 'undef';

}
binarySearch('test.txt', "ключ23548");

echo "\nВремя выполнения скрипта: " . round(microtime(true) - $s, 4) . ' сек.';
