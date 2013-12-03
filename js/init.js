
jQuery(document).ready(function(){
    
    
    // Capture du click sur le bouton ajouter une réponse
    jQuery('#btn_ajouter_reponse').click(function(){
        
       $reponses = jQuery("#reponses");
       
       
       $rep = $reponses.children().first().clone();
              
       $nombre_reponses = $reponses.children().size() +1;
       
       /**
        * On change le nom et l'attribut for du champ label en y prefixant le nomre de réponses
        */
       $rep.children('label').text("Réponse "+$nombre_reponses).attr('for', "reponse_"+$nombre_reponses);       
       $rep.children("input[type=text]").attr('id', "reponse_"+$nombre_reponses);
       
       /**
        * On ajoute l'élément que l'on vient de cloner dans la liste des réponses
        */
       $rep.appendTo($reponses);
    });
   
    console.log();
    
});