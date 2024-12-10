<?php
// src/Controllers/ScheduleController.php

namespace App\Controllers;

use App\Models\Schedule;

class ScheduleController {
    public function list() {
        $scheduleModel = new Schedule();
        $schedules = $scheduleModel->getAllSchedules();

        $view = __DIR__ . '/../../Views/admin/schedules/list.php';
        $pageTitle = 'Liste des Horaires';
        require_once __DIR__ . '/../../Views/layouts/templatedashboard.php';
    }

    public function create($data) {
        $scheduleModel = new Schedule();
        $success = $scheduleModel->insertSchedule($data);

        if ($success) {
            header('Location: /admin/schedules/list.php');
            exit;
        } else {
            echo "Erreur lors de la création de l'horaire.";
        }
    }

    public function edit($id, $data) {
        $scheduleModel = new Schedule();
        $success = $scheduleModel->updateSchedule($id, $data);

        if ($success) {
            header('Location: /admin/schedules/list.php');
            exit;
        } else {
            echo "Erreur lors de la mise à jour de l'horaire.";
        }
    }

    public function delete($id) {
        $scheduleModel = new Schedule();
        $success = $scheduleModel->deleteSchedule($id);

        if ($success) {
            header('Location: /admin/schedules/list.php');
            exit;
        } else {
            echo "Erreur lors de la suppression de l'horaire.";
        }
    }
}

