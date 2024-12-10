<h1>Ajouter / Modifier un horaire</h1>
<form method="POST" action="save.php">
    <label>Jour :</label>
    <input type="text" name="day" value="<?= $schedule['day'] ?? '' ?>" required>

    <label>Heure d'ouverture :</label>
    <input type="time" name="opening_time" value="<?= $schedule['opening_time'] ?? '' ?>">

    <label>Heure de fermeture :</label>
    <input type="time" name="closing_time" value="<?= $schedule['closing_time'] ?? '' ?>">

    <label>Fermé :</label>
    <input type="checkbox" name="is_closed" <?= isset($schedule['is_closed']) && $schedule['is_closed'] ? 'checked' : '' ?>>

    <button type="submit">Enregistrer</button>
</form>
