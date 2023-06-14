<section style="margin-top: 5rem">
    <div class="login-container">
        <h5>Créer un article</h5>
        <div class="form-login">
            <form action="/articles/create" method="POST" enctype="multipart/form-data">
                <div>
                    <label for="title_create">Titre du sujet</label>
                    <input type="text" placeholder="Titre" name="title_create"
                           id="title_create" required>
                </div>
                <div>
                    <label for="content">Contenu de l'article :</label>
                    <textarea minlength="60" maxlength="600" placeholder="Contenu" name="content"
                              id="content" required></textarea>
                </div>
                <input id="login" type="submit" value="Créer" name="create_content">
            </form>
        </div>
    </div>
</section>





