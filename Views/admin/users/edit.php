
<form method="POST" action="/index.php?controller=user&action=updateUser">
    <!-- Champ hidden pour l'ID de l'utilisateur -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($user->id) ?>">

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user->email) ?>" required>
    </div>
    <div class="mb-3">
        <label for="first_name" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="first_name" name="first_name" value="<?= htmlspecialchars($user->first_name) ?>" required>
    </div>
    <div class="mb-3">
        <label for="last_name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="last_name" name="last_name" value="<?= htmlspecialchars($user->last_name) ?>" required>
    </div>
    <div class="mb-3">
        <label for="role" class="form-label">Rôle</label>
        <select class="form-control" id="role" name="role" required>
            <option value="veterinaire" <?= $user->role === 'veterinaire' ? 'selected' : '' ?>>Vétérinaire</option>
            <option value="employe" <?= $user->role === 'employe' ? 'selected' : '' ?>>Employé</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
</form>
