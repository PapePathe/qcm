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