<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

$file = __DIR__ . '/storage.json';

if (!file_exists($file)) {
    file_put_contents($file, json_encode([
        "unique" => 0,
        "sessions" => []
    ]));
}

$data = json_decode(file_get_contents($file), true);

$timeout = 300;

$sid = 'sess_' . session_id();
$now = time();

$first_visit = !isset($_SESSION['counted']);

if ($first_visit) {
    $data['unique']++;
    $_SESSION['counted'] = true;
}

$data['sessions'][$sid] = $now;

foreach ($data['sessions'] as $s => $last_time) {
    if ($now - $last_time > $timeout) {
        unset($data['sessions'][$s]);
    }
}

$online = count($data['sessions']);

file_put_contents($file, json_encode($data, JSON_PRETTY_PRINT));

echo json_encode([
    "unique" => $data['unique'],
    "online" => $online
]);