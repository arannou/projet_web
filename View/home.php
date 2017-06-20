<div class="right_col" role="main">

    <div class="row tile_count">
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Nombre d'utilisateurs</span>
            <div class="count"><?php echo($controller->userNumber) ?></div>
<!--            <span class="count_bottom"><i class="green">4% </i> From last Week</span>-->
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-key"></i> Nombre de clés</span>
            <div class="count"><?php echo($controller->keysNumber) ?></div>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-key"></i> Nombre d'emprunts</span>
            <div class="count"><?php echo($controller->borrowingsNumber) ?></div>
            <span class="count_bottom"><i><?php echo($controller->borrowingsThisWeek) ?></i> cette semaine</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-key"></i> Emprunts en cours</span>
            <div class="count"><?php echo(count($controller->borrowings)) ?></div>
            <span class="count_bottom"><i class="red"><i class="fa fa-sort-desc"></i>12% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Collections</span>
            <div class="count">2,315</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Total Connections</span>
            <div class="count">7,325</div>
            <span class="count_bottom"><i class="green"><i class="fa fa-sort-asc"></i>34% </i> From last Week</span>
        </div>
    </div>

    <div class="col-md-4 col-sm-4 col-xs-12">
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
    <div class="col-md-4 col-sm-4 col-xs-12">
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
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="x_panel tile">
            <div class="x_title">
                <h2>App Versions</h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                    <ul class="list-unstyled top_profiles scroll-view">
                      <li class="media event">
                        <a class="pull-left border-aero profile_thumb">
                          <i class="fa fa-user aero"></i>
                        </a>
                        <div class="media-body">
                          <a class="title" href="#">Ms. Mary Jane</a>
                          <p><strong>$2300. </strong> Agent Avarage Sales </p>
                          <p> <small>12 Sales Today</small>
                          </p>
                        </div>
                      </li>
                      <li class="media event">
                        <a class="pull-left border-green profile_thumb">
                          <i class="fa fa-user green"></i>
                        </a>
                        <div class="media-body">
                          <a class="title" href="#">Ms. Mary Jane</a>
                          <p><strong>$2300. </strong> Agent Avarage Sales </p>
                          <p> <small>12 Sales Today</small>
                          </p>
                        </div>
                      </li>
                      <li class="media event">
                        <a class="pull-left border-blue profile_thumb">
                          <i class="fa fa-user blue"></i>
                        </a>
                        <div class="media-body">
                          <a class="title" href="#">Ms. Mary Jane</a>
                          <p><strong>$2300. </strong> Agent Avarage Sales </p>
                          <p> <small>12 Sales Today</small>
                          </p>
                        </div>
                      </li>
                      <li class="media event">
                        <a class="pull-left border-aero profile_thumb">
                          <i class="fa fa-user aero"></i>
                        </a>
                        <div class="media-body">
                          <a class="title" href="#">Ms. Mary Jane</a>
                          <p><strong>$2300. </strong> Agent Avarage Sales </p>
                          <p> <small>12 Sales Today</small>
                          </p>
                        </div>
                      </li>
                      <li class="media event">
                        <a class="pull-left border-green profile_thumb">
                          <i class="fa fa-user green"></i>
                        </a>
                        <div class="media-body">
                          <a class="title" href="#">Ms. Mary Jane</a>
                          <p><strong>$2300. </strong> Agent Avarage Sales </p>
                          <p> <small>12 Sales Today</small>
                          </p>
                        </div>
                      </li>
                    </ul>

                <div class="clearfix"></div>
            </div>

        </div>
    </div>
    <hr>
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                Emprunts en cours
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
                        echo '<td>'.$borrowing['borrowDate']->getTimestamp().'</td>';
                        echo '<td>'.$borrowing['dueDate']->getTimestamp().'</td>';
                        if(isset($borrowing['returnDate'])) $borrowing['returnDate'] = $borrowing['returnDate']->getTimestamp();
                        echo '<td>'.$borrowing['returnDate'].'</td>';
                        if(isset($borrowing['lostDate'])) $borrowing['lostDate'] = $borrowing['lostDate']->getTimestamp();
                        echo '<td>'.$borrowing['lostDate'].'</td>';
                        echo '<td>'.$borrowing['comment'].'</td>';
                        echo '<td>'.$borrowing['status'].'</td>';
                        if(!isset($borrowing['lostDate'])) {
                            echo '<td><a href="?/loseKeychainForm/'.$borrowing['borrowingId'].'"><button class="btn btn-primary">Perdu</button></a></td>';
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
