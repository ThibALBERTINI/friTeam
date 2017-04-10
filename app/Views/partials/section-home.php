
	<section>
		<h2>h2 de Views/partials/section-home</h2>
	</section>

	<section>
	    <h3 class="h3-section-home">Notre catalogue de formation</h3>
	    	<p>Pour recevoir notre catalogue, veuillez remplir le formulaire ci-dessous</p>
	    <form class="form-ajax" method="GET" action="piege-a-hacker.php">
	        <input type="email" name="email" required placeholder="EMAIL">
	        <button type="submit">Recevoir le catalogue !</button>
	            
	        <!-- INFOS TECHNIQUES -->
	        <input type="hidden" name="operation" value="newsletter">
	        <div class="message"></div>
	    </form>
	</section>          
