<?php
// src/Controllers/ScheduleController.php

namespace App\Controllers;

use App\Models\Schedule;

class ScheduleController {
    public function list() {
        $scheduleModel = new Schedule();
        $schedules = $scheduleModel->getAllSchedules();

        $scheduleModel = new Schedule(); 
$schedules = $scheduleModel->getAllSchedules();

if (empty($schedules)) {
    error_log('Aucun horaire trouvé depuis MongoDB.');
    $schedules = [['day' => 'unknown', 'opening_time' => 'Fermé', 'closing_time' => 'Fermé']];
}

// Le jour actuel
$today = date('l');

// Filtrer pour le jour actuel
$todaySchedule = array_filter($schedules, function ($schedule) use ($today) {
    return strtolower($schedule['day']) === strtolower($today);
});

$todaySchedule = reset($todaySchedule) ?: [
    'opening_time' => 'Fermé',
    'closing_time' => 'Fermé'
];


        $view = __DIR__ . '/../../Views/admin/schedules/list.php';
        $pageTitle = 'Liste des Horaires';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }
}

