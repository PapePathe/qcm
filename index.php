
<html>
    <head>
        <title>QCM</title>
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/styles.css" />
        
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    </head>
    <body>

        <br /><br />    

        <div class='container'>

            <?php
                
                if(isset($_POST['enregistrer']))
                {
                    $valid = true;

                    if (empty($_POST['libelle_question'])) {
                        $valid = false;
                    }

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



                        $requete_question = mysql_query("insert into questions(libelle) values('$libelle_question')");

                        if ($requete_question) {
                            $last_question_id = mysql_insert_id();

                            $nombre_reponses_inserees = 0;

                            foreach ($reponses as $key => $reponse) {
                                if (!empty($reponse)) {
                                    $correcte = (isset($_POST['reponses_vraies'][$key]) && $_POST['reponses_vraies'][$key] == 'vrai')? 1 : 0;
                                    $requete_reponse = mysql_query("INSERT INTO reponses (libelle, id_question, correcte) VALUES ('$reponse', $last_question_id, $correcte)");
                                    if ($requete_reponse) {
                                        $nombre_reponses_inserees++;
                                    } else {
                                        echo mysql_error();
                                    }
                                }
                            }

                            echo "<div class='alert alert-success'>Une question et $nombre_reponses_inserees reponses ajoutees.</div> ";
                        } else {
                            echo mysql_error();
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
                                    <input type="text" name='libelle_question' class="form-control" id="libelle_question" placeholder="...">
                                </div>
                                
                                <div id="reponses">
                                    <div class="form-group" class='reponse'>
                                        <label for="reponse_1">Réponse 1</label>
                                        <input type="text" name='reponses[]' class="form-control" id="reponse_1" placeholder="...">   
                                        <div class="checkbox">
                                            <label>
                                              <input type="checkbox" value="vrai" name='reponses_vraies[]'>
                                              cocher si la reponse est vraie!
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group"  class='reponse'>
                                        <label for="reponse_2">Réponse 2</label>
                                        <input type="text" name='reponses[]' class="form-control" id="reponse_2" placeholder="...">   
                                        <div class="checkbox">
                                            <label>
                                              <input type="checkbox" value="vrai" name='reponses_vraies[]'>
                                              cocher si la reponse est vraie!
                                            </label>
                                        </div>                                   
                                    </div>
                                    
                                </div>
                                <a href='#' title='ajouter une réponse' id='btn_ajouter_reponse'>ajouter une réponse</a>
                            </div>
                            <div class="panel-footer centered">
                                <div class='btn-toolbar'>
                                    <button type="submit" class="btn btn-success" name='enregistrer'>enregistrer</button> 
                                    <button type="submit" class="btn btn-warning" name='reinitialiser' id='btn_reinitialiser'>réinitialiser</button>
                                </div>
                            </div>
                        </div>                        
                    </form>
                </div>
                <div class="col-md-8">

                    <table class="table table-hover table-bordered table-condensed">
                        <thead>
                            <tr>
                                <th>Questions</th>
                                <th>Réponses</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <?php
                            
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
                            
                            
                            $questions = mysql_query("select * from questions");
                            if ($questions) {
                                while($question = mysql_fetch_assoc($questions))
                                {
                                    
                                    
                                    $tr = "<tr><td>".$question['libelle']."</td><td><ul>";
                                    
                                    $select_reponses = mysql_query("select * from reponses where id_question=".$question['id']);
                                    
                                    if ($select_reponses) {
                                        while ($reponse = mysql_fetch_assoc($select_reponses)) {
                                            $label = $reponse['correcte'] == 0 ? 'danger' : 'success';
                                            $tr .= "<li><span class='label label-$label'>". $reponse['libelle'] ."</span></li>";
                                        }
                                    }
                                    
                                    $tr .= "</ul></td><td> <a href='supprimer-question.php?id=".$question['id']."'>supprimer</a></td></tr>";
                                    
                                    echo $tr;
                                }    
                            }
                            
                        
                        ?>
                    </table>

                </div>
                
                

            </div>

        </div>

    </body>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/init.js"></script>
</html>
