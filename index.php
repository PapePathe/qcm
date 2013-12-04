<?php include_once 'partiels/header.php'; ?>

        <br /><br />    

        <div class='container'>

            <?php
                
                if(isset($_POST['enregistrer']))
                {
                    $valid = true;
                    
                    /**
                     * [INVALIDE] Si le libelle de la question est vide
                     */
                    if (empty($_POST['libelle_question'])) { 
                        $valid = false;
                    }
                    
                    /**
                     * [INVALIDE] Si le tableau des réponses contient moins de deux éléments
                     */
                    if (count($_POST['reponses']) < 2) {
                        $valid = false;
                    }
                    
                    /**
                     * [INVALIDE] Si le tableau des réponses vraies est vide
                     */
                    if (empty($_POST['reponses_vraies'])) {
                        $valid = false;
                    }
                    
                    /**
                     * [INVALIDE] Si une des réponses est vide 
                     */
                    foreach ($_POST['reponses'] as $reponse) {
                        if (empty($reponse)) {
                            $valid = false;
                        }
                    }


                    if ($valid) {
                        extract($_POST);
                        $serverList = array('localhost', '127.0.0.1');
                        if(in_array($_SERVER['HTTP_HOST'], $serverList))
                        {                            
                            // connexion et selection de la base
                            mysql_connect("localhost", "root", "");
                            mysql_select_db("qcm");
                        }
                        else
                        {                            
                            // connexion et selection de la base
                            mysql_connect("localhost", "lagenced_stage", "quizz@3w");
                            mysql_select_db("lagenced_stage");
                        }



                        $requete_question = mysql_query("insert into questions(libelle) values('".mysql_real_escape_string($libelle_question)."')");

                        if ($requete_question) {
                            $last_question_id = mysql_insert_id();

                            $nombre_reponses_inserees = 0;

                            foreach ($reponses as $key => $reponse) {
                                if (!empty($reponse)) {
                                    $correcte = (isset($_POST['reponses_vraies'][$key]) && $_POST['reponses_vraies'][$key] == 'vrai')? 1 : 0;
                                    $requete_reponse = mysql_query("INSERT INTO reponses (libelle, id_question, correcte) VALUES ('".mysql_real_escape_string($reponse)."', $last_question_id, $correcte)");
                                    if ($requete_reponse) {
                                        $nombre_reponses_inserees++;
                                    } else {
                                        echo mysql_error();
                                    }
                                }
                            }

                            echo "<div class='alert alert-success'>Une question et $nombre_reponses_inserees reponses ajoutees.</div> ";
                        } else {
                            echo mysql_error() . "sur la requete d'ajout des questions";
                        }
                    }
                    else
                    {
                        echo "<div class='alert alert-warning'>Certains champs du formulaire sont vides. <br> Merci de les renseigner.</div> ";
                    }
                }
            ?>

            <?php if(isset($_GET) && !empty($_GET['message'])): ?>
            <div class='alert alert-success'>
                <?php echo $_GET['message']; unset($_GET['message']) ?>
            </div>
            <?php endif ?>
                
            <div class="row">
                <div class="col-md-4">

                    <form role='form' method="POST" action="index.php">
                        <div class="panel panel-default">
                            <div class="panel-heading">Nouvelle question</div>
                            <div class="panel-body">


                                <div class="form-group">
                                    <label for="libelle_question">texte de la question</label>
                                    <input type="text" name='libelle_question' class="form-control" id="libelle_question" placeholder="..." 
                                           value="<?php if(isset($_POST['libelle_question'])) {echo $_POST['libelle_question'];} else  {echo "";}   ?>">
                                </div>
                                
                                <div id="reponses">
                                    
                                <?php if(isset($_POST['reponses'])): ?>
                                    
                                    <?php foreach($_POST['reponses'] as $key => $reponse): ?>
                                        <div class="form-group" class='reponse'>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <label for="reponse_1">Réponse <?php echo $key ?></label>
                                                    <input type="text" name='reponses[]' class="form-control" id="reponse_<?php echo $key ?>" 
                                                           placeholder="..." value ="<?php echo $reponse ?>">   
                                                    <div class="checkbox">
                                                        <label>
                                                          <input type="checkbox" value="vrai" name='reponses_vraies[]' 
                                                              <?php if( isset($_POST['reponses_vraies'][$key]) && $_POST['reponses_vraies'][$key] == 'vrai') {echo 'checked';}  ?> >
                                                          cocher si la reponse est vraie!
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <a href='#' title='supprimer cette réponse' class="lien-supprimer-reponse">
                                                        <span class="glyphicon glyphicon-minus-sign"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>                                   
                                    
                                    <?php endforeach; ?>
                                    
                                <?php else: ?>
                                    
                                    <?php for($i=0; $i<2; $i++): ?>                                  
                                        <div class="form-group" class='reponse'>
                                            <div class="row">
                                                <div class="col-md-10">
                                                    <label for="reponse_1">Réponse <?php echo $i ?></label>
                                                    <input type="text" name='reponses[]' class="form-control" id="reponse_<?php echo $i ?>" placeholder="...">   
                                                    <div class="checkbox">
                                                        <label>
                                                          <input type="checkbox" value="vrai" name='reponses_vraies[]'>
                                                          cocher si la reponse est vraie!
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <a href='#' title='supprimer cette réponse' class="lien-supprimer-reponse">
                                                        <span class="glyphicon glyphicon-minus-sign"></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>                                     
                                    <?php endfor; ?>
                                    
                                <?php endif ?>
                                    
                                          
                                    
                                    
                                </div>
                                <a href='#' title='ajouter une réponse' id='btn_ajouter_reponse' class="btn btn-default pull-right">ajouter une réponse</a>
                            </div>
                            <div class="panel-footer centered">
                                <div class='btn-toolbar'>
                                    <button type="submit" class="btn btn-success" name='enregistrer'>enregistrer</button> 
                                    <button type="submit" class="btn btn-danger"  name='reinitialiser' id='btn_reinitialiser'>réinitialiser</button>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>
                <div class="col-md-8">
                    <?php include 'partiels/questions/liste.php'; ?>
                </div>
                
                

            </div>

        </div>

<?php include_once 'partiels/footer.php'; ?>
