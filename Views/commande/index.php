<section class="historique_commande_page">
    <section class="historique_commande_tab">
        <?php
        if (empty($commande_data)) {
            echo "<h2>Aucune Commande</h2>";
        }
        if (!empty($commande_data)) {
        ?>
            <h1>Mes Commandes</h1>
            <table class="table">
                <tr>
                    <th>Date D'Achat</th>
                    <th>ID de Commande</th>
                    <th>Nom De L'Article</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Cout Livraison</th>
                    <th>Numero de Suivi</th>
                </tr>
                <?php
                foreach ($commande_data as $commande) {
                ?>
                    <tr>
                        <td><?= $commande->date_achat ?></td>
                        <td><?= $commande->annonce_id ?></td>
                        <td><?= $commande->annonce_name ?></td>
                        <td><?= $commande->quantite ?></td>
                        <td><?= $commande->prix_commande ?></td>
                        <td><?= $commande->prix_livraison ?></td>
                        <td>UAD-<?= $commande->suivi ?></td>
                    </tr>
            </table>
    <?php
                }
            }
    ?>
    </section>
</section>