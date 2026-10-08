<?php

$ar = json_decode(file_get_contents('resources/lang/ar.json'), true);

for ($i = 0; $i < 5; $i++) {
    $file = "translated_$i.json";
    if (file_exists($file)) {
        $trans = json_decode(file_get_contents($file), true);
        if ($trans) {
            foreach ($trans as $k => $v) {
                $ar[$k] = $v;
            }
        }
    }
}

file_put_contents('resources/lang/ar.json', json_encode($ar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
echo "Successfully merged translations!\n";
