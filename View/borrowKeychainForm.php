<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Clés</h3>
      </div>
      <hr>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Emprunter une clé
          </div>
          <div class="x_content">
          <form action="?/borrowKeychain" method="post" data-parsley-validate class="form-horizontal form-label-left">
            <?php
                if($controller->error != ""){
                    echo $controller->error;
                }
             ?>

            <div class="form-group">
            <label class="control-label col-md-3 col-sm-3 col-xs-12">Identifiant:</label>
            <select name = "userEnssatPrimaryKey">
              <?php
              foreach($controller->users as $user){ ?>
                <option value = "<?php echo $user->getEnssatPrimaryKey(); ?>"><?php echo $user->getName()." ".$user->getSurname(); ?></option>
                <?php  } ?>
              </select>
            </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">ID trousseau :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" name = "keychainId">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de retour :</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type = "date" name = "dueDate">
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
