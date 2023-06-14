<?php

use App\Model\Entity\User;

?>
<div style="margin-top: 10rem" id="list">
        <?php if (!empty($params['message'])): ?>
            <p style="color: red;"><?= $params['message'] ?></p>
        <?php endif; ?>
    <div class="box-list">
        <p>Listing des utilisateurs</p>
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Pseudo</th>
                <th>Admin</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody><?php
            if (!empty($params['users'])) {
                foreach ($params['users'] as $user) {
                    /* @var User $user */ ?>
                    <tr>
                        <td><?= $user->getId() ?></td>
                        <td><?= $user->getEmail() ?></td>
                        <td><?= $user->getPseudo() ?></td>
                        <td><?= $user->isAdmin() ?></td>
                        <td><a href="/user/delete/<?= $user->getId(); ?>">Supprimer l'utilisateur</a></td>
                    </tr> <?php
                }
            }
            ?></tbody>
        </table>
    </div>
    <div class="footer-list">
        <a href="/article">Voir la page articles</a>
        <a href="/articles">Voir la page des composants</a>
    </div>
</div>

