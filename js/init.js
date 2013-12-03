
jQuery(document).ready(function(){
    
    
    // Capture du click sur le bouton ajouter une réponse
    jQuery('#btn_ajouter_reponse').click(function(){
        
       $reponses = jQuery("#reponses");
       
       /**
        * on conserve les event handers tout en clonant la div
        */
       $rep = $reponses.children().first().clone(true, true);
              
       $nombre_reponses = $reponses.children().size() +1;
       
       /**
        * On change le nom et l'attribut for du champ label en y prefixant le nomre de réponses
        */
       $rep.find('label').first().text("Réponse "+$nombre_reponses).attr('for', "reponse_"+$nombre_reponses);       
       $rep.find("input[type=text]").attr('id', "reponse_"+$nombre_reponses).val('');     
       $rep.find(".checkbox input[type=checkbox]").attr('checked', false);
       
       /**
        * On ajoute l'élément que l'on vient de cloner dans la liste des réponses
        */
       $rep.appendTo($reponses);
       
        /**
         * On cache tous les liens servant à supprimer les réponses 
         * On affiche le dernier de ces liens
         */
        jQuery('.lien-supprimer-reponse').hide();
        jQuery('.lien-supprimer-reponse').last().show()();
      
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
    
    /**
     * Capture du click sur les liens supprimer réponse dans le formulaire de création des questions
     */
    jQuery('.lien-supprimer-reponse').click(function (){
        return jQuery(this).each(function(){
            
            if(jQuery('.lien-supprimer-reponse').size() > 2) // si le nombre de liens est > à 2 on supprime rien!
            {
                // imprtant ne pas changer la structure du formulaire au risque de faire buggger!!
                // todo: make this portable
                jQuery(this).parent().parent().parent().remove();      
                jQuery('.lien-supprimer-reponse').last().show();
            }
            else // on ne supprime rien, l'user reçoit un message d'alerte
            {
                alert('impossible de supprimer. une question necessite au moins deux réponses');
            }
            
        });
        
    });
    
});