<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Utilisateurs</h3>
            </div>
            <hr>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        Liste des canons
                    </div>

                    <div class="x_content">
                        <table class="table">
                            <thead>
                                <th>Id</th>
                                <th>doorId</th>
                                <th>Salle associée</th>
                                <th>Length</th>
                            </thead>
                            <?php
                            foreach ($controller->locks as $index => $lock) {
                                echo '<tr>';
                                echo '<td>'.$lock->getId().'</td>';
                                echo '<td>'.$lock->getDoorId().'</td>';
                                echo '<td>'.$controller->roomIds[$index].'</td>';
                                echo '<td>'.$lock->getLength().'</td>';
                                echo '</tr>';
                            }

                            ?>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
