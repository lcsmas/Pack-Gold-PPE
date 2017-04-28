<form action="/ma-page-de-traitement" method="post">
    <div id="article_autre">
        <h1><img class="ico_categorie" src="<?php echo chemins::IMAGES . 'ico_epingle.png'; ?>">Me contacter</h1>
        <p> Lucas Mas <br /> 10 rue le parc, Villeneuve-lès-Beziers, 34420 <br /> 06.62.40.24.81 <br /> lucas_mas@msn.com <br /></p>
        <h2 align="center"> Formulaire de contact : </h2>

        <table align="center">	
            <br />
            <tr><td><label for="nom">Nom :</label></td> <td><input type="text" id="nom" name="user_name" /></td></tr>

            <tr><td><label for="courriel">Courriel :</label></td> <td><input type="email" id="courriel" name="user_email" /></td></tr>

            <tr><td><label for="message">Message :</label></td><td><textarea id="message" name="user_message"></textarea></td></tr>

            <tr><td></td><td><a href="index.php?cas=envoi"><input type="button" value ="Envoyer votre message"></a></td></tr>
        </table>
    </div>
</form>
</section>
