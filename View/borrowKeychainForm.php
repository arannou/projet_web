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
                        Emprunter un trousseau
                    </div>
                    <div class="x_content">
                        <table class="table">
                            <thead>
                                <th>Identifiant</th>
                                <th>clés</th>

                            </thead>
                            <?php
                            foreach ($controller->keychains as $index => $keychain) {
                                echo '<tr>';
                                echo '<td>'.$keychain->getId().'</td>';
                                echo '<td>'.json_encode($controller->keychainsKeys[$index]).'</td>';
                                echo '</tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="x_panel">
                    <div class="x_title">
                        Emprunter un trousseau
                    </div>
                    <div class="x_content">
                        <form action="?/borrowKeychain" method="post" data-parsley-validate class="form-horizontal form-label-left">
                            <?php
                            if($controller->error != ""){
                                echo $controller->error;
                            }
                            ?>

                            <div class="form-group" id="keyChainSelector">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Trousseaux existant</label>
                                <select class="" name="">
                                    <?php
                                    foreach($controller->keychains as $keychain){ ?>
                                        <option value = "<?php echo $keychain->getId(); ?>"><?php echo $keychain->getId(); ?></option>
                                        <?php  } ?>
                                    </select>
                                    <button type="button" name="button" id="showKeyChainCreator">Creer un trousseau</button>
                                </div>

                                <div class="form-group" id="keyChainCreator">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Former un trousseau :</label>
                                    <select id="availableKeys">
                                        <?php
                                        foreach($controller->availableKeys as $key){ ?>
                                            <option value = "<?php echo $key->getId(); ?>"><?php echo $key->getId(); ?></option>
                                            <?php  } ?>
                                        </select>

                                        <button type="button" id="addKey">=></button>
                                        <button type="button" id="returnKey"><=</button>

                                        <select id="keyChain">

                                        </select>

                                        <button type="button" name="button" id="showKeyChainSelector">Utiliser un trousseau existant</button>

                                        <input type="hidden" name="keys" id="selectedKeys" value="">
                                    </div>

                                    <input type="hidden" id="keychainSelection" name="keychainSelection" value="selection">

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
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Date de retour :</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type = "date" name = "dueDate">
                                            </div>
                                        </div>
                                        <p><input type="submit" value="Envoyer" class="btn btn-warning" /></p>
                                    </form>
                                </div>
                            </div>
                            <div class="x_panel">
                                <div class="x_title">
                                    Ajout de trousseaux par CSV
                                </div>
                                <div class="form-group">
                                    <form action="?/uploadKeychainCSV" method="post" enctype="multipart/form-data" data-parsley-validate class="form-horizontal form-label-left">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Fichier CSV :</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="file" name="keychainCSV">
                                            </div>
                                        </div>
                                        <br>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="submit" value="Envoyer" class="btn btn-warning" >
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script src="./Asset/js/keyChainCreation.js" charset="utf-8"></script>
