<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Emprunt</h3>
      </div>
      <hr>
      <!-- Formulaire pour prolonger un emprunt -->
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Prolonger un emprunt
          </div>

          <div class="x_content">
          <form action="?/extendBorrowing" method="post" data-parsley-validate class="form-horizontal form-label-left">
            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Trousseau :</label>
            <input type="number" name=id readonly value="<?php echo($controller->borrowing) ?>" />
            </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Nouvelle date de retour :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type = "date" name = "newDueDate">
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
