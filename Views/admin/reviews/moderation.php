<?php
use App\Models\Reviews;
?>


<!-- Views/admin/reviews/moderation.php -->
<h2>Modération des Avis</h2>
<?php if (!empty($pendingReviews)): ?>
    <table>
        <thead>
            <tr>
                <th>Pseudo</th>
                <th>Email</th>
                <th>Commentaire</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pendingReviews as $review): ?>
            <tr>
                <td><?= htmlspecialchars($review->visitor_pseudo) ?></td>
                <td><?= htmlspecialchars($review->email) ?></td>
                <td><?= htmlspecialchars($review->comment) ?></td>
                <td><?= $review->created_at ?></td>
                <td>
                    <form action="/index.php?controller=review&action=approveReview" method="POST" style="display:inline;">
                        <input type="hidden" name="review_id" value="<?= $review->id ?>">
                        <button type="submit">Approuver</button>
                    </form>
                    <form action="/index.php?controller=review&action=rejectReview" method="POST" style="display:inline;">
                        <input type="hidden" name="review_id" value="<?= $review->id ?>">
                        <button type="submit">Refuser</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>
<?php else: ?>
    <p>Aucun avis en attente de modération.</p>
<?php endif; ?>

<h3>Historique des Avis Refusés</h3>
<table>
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Commentaire</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $rejectedReviews = Reviews::getRejectedReviews();
        foreach ($rejectedReviews as $review): ?>
            <tr>
                <td><?= htmlspecialchars($review->visitor_pseudo) ?></td>
                <td><?= htmlspecialchars($review->email) ?></td>
                <td><?= htmlspecialchars($review->comment) ?></td>
                <td><?= $review->created_at ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
