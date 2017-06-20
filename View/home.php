<div class="right_col" role="main">

    <div class="row tile_count">
        <div class="col-md-2 col-sm-3 col-xs-3 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Nombre d'utilisateurs</span>
            <div class="count"><?php echo($controller->userNumber) ?></div>
            <span class="count_bottom"><i><?php echo($controller->studentNumber) ?> </i> sont des étudiants</span>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 tile_stats_count">
            <span class="count_top"><i class="fa fa-key"></i> Nombre de clés</span>
            <div class="count"><?php echo($controller->keysNumber) ?></div>
            <span class="count_bottom"><i><?php echo($controller->passNumber) ?></i> sont des passes</span>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 tile_stats_count">
            <span class="count_top"><i class="fa fa-key"></i> Nombre d'emprunts</span>
            <div class="count"><?php echo($controller->borrowingsNumber) ?></div>
            <span class="count_bottom"><i><?php echo($controller->borrowingsThisWeek) ?></i> cette semaine</span>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 tile_stats_count">
            <span class="count_top"><i class="fa fa-key"></i> Emprunts en cours</span>
            <div class="count"><?php echo(count($controller->borrowings)) ?></div>
            <span class="count_bottom"><i><?php echo($controller->lateNumber) ?></i> en retard</span>
        </div>
    </div>

    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Emprunts en cours</h2>
                <div class="clearfix"></div>
            </div>
            <table class="table">
                <thead>
                    <th>N° d'emprunt</th>
                    <th>Emprunteur</th>
                    <th>Clés</th>
                    <th>Date d'emprunt</th>
                    <th>A rendre le</th>
                    <th>Rendu le</th>
                    <th>Perdu le</th>
                    <th>Commentaire</th>
                    <th>Etat</th>
                    <th></th>
                    <th></th>
                    <th></th>

                </thead>
                <tbody>
                    <?php
                    foreach ($controller->borrowings as $borrowing) {
                        echo '<tr>';
                        echo '<td>'.$borrowing['borrowingId'].'</td>';
                        echo '<td>'.$controller->getUserNameByEnssatPrimaryKey($borrowing['userEnssatPrimaryKey']).'</td>';
                        echo '<td>'.$borrowing['keychainId'].'</td>';
                        echo '<td>'.date_format($borrowing['borrowDate'], 'd/m/Y').'</td>';
                        echo '<td>'.date_format($borrowing['dueDate'], 'd/m/Y').'</td>';
                        echo '<td>'.date_format($borrowing['returnDate'], 'd/m/Y').'</td>';
                        echo '<td>'.date_format($borrowing['lostDate'], 'd/m/Y').'</td>';
                        echo '<td>'.$borrowing['comment'].'</td>';
                        echo '<td>'.$borrowing['status'].'</td>';
                        if(!isset($borrowing['lostDate'])) {
                            echo '<td><a href="?/loseKeychainForm/'.$borrowing['borrowingId'].'"><button class="btn btn-primary">Perdu</button></a></td>';
                        } else echo '<td></td>';
                        echo '<td><a href="?/extendBorrowingForm/'.$borrowing['borrowingId'].'"><button type="button" class="btn btn-warning">Prolonger</button></a></td>';
                        if(!isset($borrowing['returnDate'])) {
                          echo '<td><a href="?/keychainReturnValider/'.$borrowing['borrowingId'].'"><button class="btn btn-primary">retourné</button></a></td>';
                        } else echo '<td></td>';

                        echo '<tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2>Emprunts en retard</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table">
                    <thead>
                        <th>Emprunteur</th>
                        <th>Trousseau</th>
                        <th>Emprunt</th>
                        <th>Rendu prévu</th>
                        <th>En retard de</th>
                    </thead>
                    <?php
                    foreach ($controller->lateBorrowings as $lateBorrowing) {

                        $delta = $controller->getDeltaInDays($lateBorrowing);

                        echo '<tr>';
                        echo '<td>'.$lateBorrowing['userEnssatPrimaryKey'].'</td>';
                        echo '<td>'.$lateBorrowing['keychainId'].'</td>';
                        echo '<td>'.date_format($lateBorrowing['borrowDate'], 'd/m/Y').'</td>';
                        echo '<td>'.date_format($lateBorrowing['dueDate'], 'd/m/Y').'</td>';
                        echo '<td>'.$delta.' jours</td>';
                        echo '</tr>';
                    }

                    ?>
                </table>

                <div class="clearfix"></div>
            </div>

        </div>
    </div>
    <div class="col-md-6 col-sm-6 col-xs-12">
        <div class="x_panel tile ">
            <div class="x_title">
                <h2>Trousseaux perdus</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">

                <table class="table">
                    <thead>
                        <th>Emprunteur</th>
                        <th>Trousseau</th>
                        <th>Emprunt</th>
                        <th>Rendu prévu</th>
                        <th>Date de perte</th>
                    </thead>
                    <?php
                    foreach ($controller->lostBorrowings as $lostBorrowing) {

                        $delta = $controller->getDeltaInDays($lostBorrowing);

                        echo '<tr>';
                        echo '<td>'.$lostBorrowing['userEnssatPrimaryKey'].'</td>';
                        echo '<td>'.$lostBorrowing['keychainId'].'</td>';
                        echo '<td>'.date_format($lostBorrowing['borrowDate'], 'd/m/Y').'</td>';
                        echo '<td>'.date_format($lostBorrowing['dueDate'], 'd/m/Y').'</td>';
                        echo '<td>'.date_format($lostBorrowing['lostDate'], 'd/m/Y').'</td>';
                        echo '</tr>';
                    }

                    ?>
                </table>

                <div class="clearfix"></div>
            </div>

        </div>
    </div>

    <div class="col-md-6 col-sm-6 col-xs-12">
      <div class="x_panel tile ">
          <div class="x_title">
              <h2>Trousseaux retournés</h2>
              <div class="clearfix"></div>
          </div>
          <div class="x_content">

              <table class="table">
                  <thead>
                      <th>Emprunteur</th>
                      <th>Trousseau</th>
                      <th>Emprunt</th>
                      <th>Rendu prévu</th>
                      <th>Date de retour</th>
                  </thead>
                  <?php

                    foreach ($controller->returnedBorrowings as $returnedBorrowing)  {

                      $delta = $controller->getDeltaInDays($returnedBorrowing);

                      echo '<tr>';
                      echo '<td>'.$returnedBorrowing['userEnssatPrimaryKey'].'</td>';
                      echo '<td>'.$returnedBorrowing['keychainId'].'</td>';
                      echo '<td>'.date_format($returnedBorrowing['borrowDate'], 'd/m/Y').'</td>';
                      echo '<td>'.date_format($returnedBorrowing['dueDate'], 'd/m/Y').'</td>';
                    //  echo '<td>'.date_format($borrowing['returnDate'], 'd/m/Y').'</td>';
                    if(isset($returnedBorrowing['returnDate'])) $returnedBorrowing['returnDate'] = date_format($returnedBorrowing['returnDate'], 'd/m/Y').'</td>';
                           echo '<td>'.$returnedBorrowing['returnDate'].'</td>';
                      echo '</tr>';
                  }

                  ?>
              </table>

              <div class="clearfix"></div>
          </div>

      </div>
  </div>



    </div>

</div>
