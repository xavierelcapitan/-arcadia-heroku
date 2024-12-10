
    <div class="container my-5">
        <h1 class="text-center mb-4">Contactez-nous</h1>
        <form action="/index.php?controller=contact&action=sendMessage" method="POST">
            <!-- Champ prénom -->
            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Votre prénom" required>
            </div>

            <!-- Champ email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" placeholder="Votre adresse email" required>
            </div>

            <!-- Champ message -->
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea name="message" id="message" rows="5" class="form-control" placeholder="Votre message..." required></textarea>
            </div>

            <!-- Bouton envoyer -->
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
        </form>
    </div>