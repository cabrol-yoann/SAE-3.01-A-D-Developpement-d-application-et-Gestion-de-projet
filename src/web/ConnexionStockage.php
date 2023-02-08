<?php
include_once "header_footer.php";

echo $header;

?>

        <section class="form-edit">
            <h2 style="text-align:center; padding:10px;">Nouveau Serveur</h1>
                <form style="text-align:center; padding:10px;" action="add.php" method="POST">
                    <label>Nom : </label>
                    <input type="text" name="Nom" required>
                    <br>
                    <label>Ip : </label>
                    <input type="text" name="Ip" required>
                    <br>
                    <label>Port : </label>
                    <input min=1 type="number" name="Port" required>
                    <br>
                    <label>Utilisateur : </label>
                    <input type="text" name="utilisateur" required>
                    <br>
                    <label>Mot de passe : </label>
                    <input type="text" name="mot de passe" required>
                    <br>
                    <label>Description : </label>
                    <input type="text" name="desc" required>
                    <br>
                    <input class="edit-bouton" type="submit" value="Ajouter !">
                </form>
        </section>

<?php
include_once "header_footer.php";

echo $footer;

?>