<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Accueil</h3>
      </div>
      <hr>
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            Liste des emprunts
          </div>
          <table class="table">
            <thead>
              <th>borrowingId</th>
              <th>userEnssatPrimaryKey</th>
              <th>keychainId</th>
              <th>borrowDate</th>
              <th>dueDate</th>
              <th>returnDate</th>
              <th>lostDate</th>
              <th>comment</th>
              <th>status</th>
              <th></th>

            </thead>
            <tbody>

              <?php
              foreach ($controller->borrowings as $borrowing) {
                echo '<tr>';
                echo '<td>'.$borrowing['borrowingId'].'</td>';
                echo '<td>'.$borrowing['userEnssatPrimaryKey'].'</td>';
                echo '<td>'.$borrowing['keychainId'].'</td>';
              echo '<td>'.date_format($borrowing['borrowDate'], 'd/m/Y').'</td>';
              echo '<td>'.date_format($borrowing['dueDate'], 'd/m/Y').'</td>';

              if(isset($borrowing['returnDate'])) $borrowing['returnDate'] = date_format($borrowing['returnDate'], 'd/m/Y').'</td>';
                     echo '<td>'.$borrowing['returnDate'].'</td>';
                echo '<td>'.$borrowing['lostDate'].'</td>';
                echo '<td>'.$borrowing['comment'].'</td>';
                echo '<td>'.$borrowing['status'].'</td>';



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
    </div>
  </div>
</div>
