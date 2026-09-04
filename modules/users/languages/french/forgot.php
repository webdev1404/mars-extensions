<?php

return [
    'email' => "E-mail",

    'username.title' => 'Nom d\'utilisateur oublié',
    'username.submit' => "Envoyer le nom d'utilisateur",
    'username.success' => "Si l'adresse e-mail saisie est associée à un compte, votre nom d'utilisateur a été envoyé à cette adresse e-mail.",

    'password.title' => 'Mot de passe oublié',
    'password.submit' => "Envoyer le lien de réinitialisation",
    'password.success' => "Si l'adresse e-mail saisie est associée à un compte, un lien de réinitialisation du mot de passe a été envoyé à cette adresse e-mail.",

    'password.reset.title' => 'Réinitialiser le mot de passe',
    'password.reset.password' => "Nouveau mot de passe",
    'password.reset.password_confirm' => "Confirmer le mot de passe",
    'password.reset.submit' => "Réinitialiser le mot de passe",
    'password.reset.success' => "Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant <a href=\"{$app->url->route('users.login')}\">vous connecter</a> avec votre nouveau mot de passe.",

    'err.email' => "Veuillez saisir votre adresse e-mail",
    'err.email.invalid' => "L'adresse e-mail saisie n'est pas valide",

    'err.password' => "Veuillez saisir votre mot de passe",
    'err.password.invalid' => "Le mot de passe saisi n'est pas valide. Il doit comporter entre 6 et 100 caractères et inclure un mélange de lettres, de chiffres et de caractères spéciaux.",
    'err.password.mismatch' => "Les mots de passe saisis ne correspondent pas",
    'err.password.params' => "Paramètres de réinitialisation du mot de passe invalides",
    'err.password.reset' => "Le lien de réinitialisation du mot de passe est invalide ou a expiré",
];
