<div class="right_col" role="main">
  <div class="">
    <!-- Formulaire de signalement de perte de trousseau -->
    <div class="page-title">
      <div class="title_left">
        <h3>Emprunt</h3>
      </div>
      <hr>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Trousseau perdu
          </div>

          <div class="x_content">
          <form action="?/loseKeychain" method="post" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Trousseau:</label>
            <!-- Récupération de l'ID du trousseau -->
            <input type="number" name=id readonly value="<?php echo($controller->borrowing) ?>" />
            </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Commentaire :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
					<textarea name=comment></textarea>
                </div>
              </div>
              <p><input type="submit" value="Envoyer" class="btn btn-warning" /></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
