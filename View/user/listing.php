<?php

use App\Model\Entity\User;

?>
<div style="margin-top: 15rem">
    <p>Listing des utilisateurs</p>
    <table>
        <thead>
        <tr>
            <th>#</th>
            <th>email</th>
            <th>pseudo</th>
            <th></th>
            <th></th>
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
                    <td><a href="/user/delete/<?= $user->getId(); ?>">Supprimer l'utilisateur</a></td>
                </tr> <?php
            }
        }
        ?></tbody>
    </table>
</div>

