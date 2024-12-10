<!-- Views/admin/users/create.php -->
<form action="/index.php?controller=user&action=createUser" method="POST">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>

    <div class="mb-3">
        <label for="first_name" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="first_name" name="first_name" required>
    </div>

    <div class="mb-3">
        <label for="last_name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="last_name" name="last_name" required>
    </div>

    <div class="mb-3">
        <label for="role" class="form-label">Rôle</label>
        <select class="form-control" id="role" name="role" required>
            <option value="employe">Employé</option>
            <option value="veterinaire">Vétérinaire</option>
            <option value="admin">Admin</option> 
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Créer</button>
</form>
