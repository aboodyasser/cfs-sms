<?php

$en = json_decode(file_get_contents('resources/lang/en.json'), true);
$ar = [];

function translateEnToAr($text) {
    if (empty(trim($text))) return $text;
    $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ar&dt=t&q=" . urlencode($text);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    $res = json_decode($response, true);
    $translated = '';
    if (isset($res[0])) {
        foreach ($res[0] as $part) {
            $translated .= $part[0];
        }
    }
    // Sleep to avoid rate limiting
    usleep(100000); 
    return $translated ?: $text;
}

// Translate in chunks of 50 to avoid timeout, maybe just translate the first 100 most important ones?
// Or we can chunk the array into 10 parts and just translate them all.
// Since it's a CLI script, it can take 1-2 minutes.
echo "Starting translation for " . count($en) . " items...\n";

// To avoid rate limits, let's translate multiple texts in one request by joining them with a special separator.
$chunks = array_chunk(array_keys($en), 20);
$total = count($chunks);
$current = 1;

foreach ($chunks as $chunk) {
    echo "Processing chunk $current of $total...\n";
    $textToTranslate = implode(" ||| ", $chunk);
    
    $translatedText = translateEnToAr($textToTranslate);
    $translatedParts = explode(" ||| ", $translatedText);
    
    foreach ($chunk as $index => $key) {
        $ar[$key] = isset($translatedParts[$index]) ? trim($translatedParts[$index]) : $key;
    }
    
    file_put_contents('resources/lang/ar.json', json_encode($ar, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    $current++;
}

echo "Translation complete!\n";
