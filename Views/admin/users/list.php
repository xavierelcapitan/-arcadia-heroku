<!-- users/list.php -->

<a href="/index.php?controller=User&action=createUser" class="btn btn-success">Ajouter un utilisateur</a>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Rôle</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= htmlspecialchars($user->last_name) ?></td>
                <td><?= htmlspecialchars($user->first_name) ?></td>
                <td><?= htmlspecialchars($user->role) ?></td>
                <td>
                <a href="/index.php?controller=User&action=editUser&id=<?= $user->id ?>" class="btn btn-primary">Modifier</a>
                <form id="deleteForm-<?= $user->id ?>" method="POST" action="/index.php?controller=user&action=deleteUser&id=<?= $user->id ?>" style="display: none;">
</form>

<a href="#" 
   class="btn btn-danger"
   onclick="if (confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?')) { document.getElementById('deleteForm-<?= $user->id ?>').submit(); } return false;">
   Supprimer
</a>


            </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
