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


$id_question = (int) $_GET['id'];

$delete_reponses = mysql_query("delete from reponses where id_question=".$id_question);

echo mysql_error();

$deleted_reponses = mysql_affected_rows();


$delete_question = mysql_query("delete from questions where id=".$id_question);


header("Location: index.php?message=Question supprimee");

