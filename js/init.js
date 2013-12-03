
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
       $rep.children("input[type=text]").attr('id', "reponse_"+$nombre_reponses).val('');     
       $rep.find(".checkbox input[type=checkbox]").attr('checked', false);
       
       /**
        * On ajoute l'élément que l'on vient de cloner dans la liste des réponses
        */
       $rep.appendTo($reponses);
    });
   
   /**
    * Capture du click sur le bouton pour réinitialiser le formulaire 
    * de création d'une question.
    */
    jQuery('#btn_reinitialiser').click(function(){
        $(this).closest('form').find('input[type=text], textarea').val('');
        $(this).closest('form').find('input[type=checkbox]').attr('checked', false);
        return false; // prevent the default action
    });
    
});