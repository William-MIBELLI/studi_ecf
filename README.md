# studi_ecf

Bienvenue sur le l'ECF de décembre 2022 pour le titre de développeur WEB full-stack.

Lien pour accéder au site en ligne : https://studiworkoutbase.herokuapp.com/

Pour vous connecter à l'application, vous avez 2 possibilités :

  1 : En ligne
  
    1.1 : Cliquer sur le lien ci-dessus.
    1.2 : Cliquer sur le bouton 'configuration', selectionner le mode de fonctionnement en 'mode online' et valider.
    1.3 : une fois la page rechargée, vous pouvez vous connecter avec les profils pré-enregistré dans la base de donnée.
    1.4 : Vous pouvez également réinitialiser la base de donnée en cliquant dans la panneau de configuration sur la bouton 'Remise à zéro'. Cela aura pour effet de supprimer toutes les modifications effectuées sur la base de données et d'insérer les données pré-enregistrées.
    
  2 : en local
  
    2.1 : Cloner le projet sur votre ordinateur.
    2.2 : Lancer votre serveur PHP et MySQL
    2.3 : Connectez vous sur 'index.php'
    2.4 : Sur la page d'accueil, cliquez sur le bouton 'configuration' et selectionnez le mode de fonctionnement 'mode local', validez.
    2.5 : une fois la page rechargée, vous pouvez vous connecter avec les profils pré-enregistrés dans la base de donnée.
    2.6 : Vous pouvez également réinitialiser la base de donnée en cliquant dans la panneau de configuration sur la bouton 'Remise à zéro'. Cela aura pour effet de supprimer toutes les modifications effectuées sur la base de données et d'insérer les données pré-enregistrées.
    
    
    !!!!!!!!!! LA LISTE DE UTILISATEURS SE TROUVENT A LA FIN DE CE FICHIER   !!!!!!!!!!!!!!!!!!!!!
    
    
L'utilisation en mode local ou online est identique : 


Connecté en tant que administrateur

  Création :
  
    Il vous suffit de cliquer soit sur le lien création dans le menu, soit de cliquer sur la box nommée 'Création'. A l'intérieur, remplissez le formulaire, validez, et l'utilisateur sera inséré en base de donnée.
    
    !! ATTENTION  !! Vous ne pouvez pas créer une structure pour un partenaire désactivé.
    
   Gestion : 
   
    Sur la page gestion, vous aurez accés à tous les partenaires et toutes les structure inscrites dans la base de donnée. Vous pouvez filtrer l'affichage en choisissant d'afficher les membres actifs, les désactivés, ou tous.
    Pour chaque membre, des boutons permettent de :
    
      - modifier : Vous pouvez modifier les informations administratives du membres, ainsi que son mail (utilisé pour la connexion) ou encore les permissions auquel il a accés. Si le membre sur lequel ces modification sont appliquées, celle-ci seront répercutées automatiquement sur toutes ses structures enfants.
      
      - désactiver/activer : change le statut du membre en 'activé' ou 'désactivé', selon son état actuel. Si le membre sur lequel vous appliquez ces modifications est un partenaire, le changement de statut s'opèrera également pour ses structures enfant de manière automatique.
      
      !!  ATTENTION !! Vous ne pouvez pas activer une structure si son partenaire parent est lui-même désactivé.
      
      - Demande : Vous trouverez sur cette page une liste des demandes de modification envoyées par les membres.
   
   
Connecté en tant que Membre (partenaire ou structure)

  Une fois connecté, vous avez accés au résmué de vos informations administrative ainsi qu'à vos permissions.
  
  Si vous désirez éffectuer des changements, vous pouvez envoyer une demande à un administrateur en cliquant dans le menu sur 'envoyer une demande' afin que la demande soit étudiée.
   
 
 
Liste des utilisateur pré-enregistrés :

william.mibelli@gmail.com       Partenaire
jean.dugenoux@gmail.com         Partenaire
crossfit.31@fit.com             Partenaire
admin@admin.com                 Administrateur

Le mot de passe est : basicpass

Celui-ci devra être réinitialisé lors de la première connexion.
