projet: gestion des licences
cette projet permet a l'admin de gerer les licences(ajouter, modifier et supprimmer),
elle contient aussi une fonctionnalite pour l'envoi de mail en cas ou la date de licence va bientot expirer
et permet a l'utilisateur simple(User) de consulter les licences uniquement sans permission de les modifier.
on trouve dans cette projet des fichiers php :
le fichier "index.php" contient la page d'accueil.
le fichier "config.php" contient le code necessaire pour la connexion au base de donnees.
le fichier "register_form.php" contient la formulaire d'inscription.
le fichier "login_form.php" contient la formulaire de connexion.
le fichier "logout.php" contient le code de deconnexion.
le fichier "user_page.php" contient la page user ou l'affichage des licences uniquement.
le fichier "admin_page.php" contient l'affichage de la page admin qui gere les licences avec les boutons(ajouter, modifier, et supprimer) .
le fichier "code.php" contient le code pour la gestion des licences (crud).
le fichier "date.php" contient le code qui affiche la licence ou la date va bientot expirer d'ici 1 mois .

dans le dossier phpmailer il ya :
le fichier "mail_alert.php" contient le code qui envoi un mail vers l'admin pour afficher la licence
 ou sa date va bientot expirer d'ici 1 mois .
