<section>
    <h3>FORMULAIRE DE LOGIN</h3>
    <form method="POST" action="">
        <input type="text"  name="login" required placeholder="LOGIN"><br>
        
        <input type="password"  name="password" required placeholder="PASSWORD"><br>
        <button type="submit">SE CONNECTER</button>
        
        <!-- INFO TECHNIQUE POUR PRECISER L'ACTION QUE LE VISITEUR VEUT REALISER -->
        <input type="hidden" name="operation" value="login">
        
        <div class="message">
            <?php if (isset($message)) echo $message ?>
        </div>
    </form>
</section>