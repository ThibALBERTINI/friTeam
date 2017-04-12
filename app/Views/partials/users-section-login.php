<section>
    <h3>FORMULAIRE DE LOGIN</h3>
    <h4>ATTENTION CETTE PARTIE DU SITE EST RESERVEE AUX ADMINISTRATEURS</h4>
    <form method="POST">
        <div class="form-group">
        <input type="text"  name="login" required placeholder="PSEUDO" class="form-control"><br>
        </div>
        <div class="form-group">
        <input type="password"  name="password" required placeholder="PASSWORD" class="form-control"><br>
        </div>
        <div class="form-group text-center">
        <button type="submit" class="btn btn-success">SE CONNECTER</button>
        </div>
        
        <!-- INFO TECHNIQUE POUR PRECISER L'ACTION QUE LE VISITEUR VEUT REALISER -->
        <input type="hidden" name="operation" value="login">
        
        <div class="message">
            <?php if (isset($message)) echo $message ?>
        </div>
    </form>
    <p class="text-center">
    <a href="<?php echo $this->url('users_loosePass') ?>"> Mot de passe perdu ? </a> <br> <br>
    <a href="<?php echo $this->url('users_loosePass') ?>"> Modifier votre mot de passe</a>
</p>
</section>