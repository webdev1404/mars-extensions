<?php

return [
    'title' => "Compte",
    'logout' => "Déconnexion",
    'hello' => "Bonjour {$app->user->username},",
    'password_new' => "Nouveau mot de passe",
    'password_new_confirm' => "Confirmer le nouveau mot de passe",
    'password_current' => "Mot de passe actuel",
    'submit' => "Mettre à jour",

    'success' => "Votre compte a été mis à jour avec succès",
    'success.email' => "Votre compte a été mis à jour avec succès. Veuillez vérifier votre email pour confirmer la nouvelle adresse email.",
    'success.email.confirmed' => "Votre adresse email a été mise à jour avec succès.",

    'err.password.current' => "Veuillez entrer votre mot de passe actuel.",
    'err.password.current.invalid' => "Votre mot de passe actuel est incorrect",

    'err.email.params' => "Paramètres de mise à jour d'email invalides",
    'err.email.failed' => "La mise à jour de l'email a échoué. Le jeton de mise à jour d'email est invalide ou a expiré. Veuillez essayer de mettre à jour votre adresse email à nouveau.",
];
