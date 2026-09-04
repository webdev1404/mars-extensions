<?php

return [
    'title' => "Inscription",
    'username' => "Nom d'utilisateur",
    'email' => "E-mail",
    'password' => "Mot de passe",
    'password_confirm' => "Confirmer le mot de passe",
    'submit' => "S'inscrire",

    'success' => "Vous vous êtes inscrit avec succès. Veuillez consulter votre e-mail pour obtenir les instructions d'activation de votre compte.",

    'agreement.title' => "Accord d'inscription",
    'agreement.link' => "J'ai lu et j'accepte les termes et conditions d'inscription.",

    'registration_closed.title' => "Inscription fermée",

    'resend_activation.link' => "Renvoyer le code d'activation",
    'resend_activation.title' => "Renvoyer le code d'activation",
    'resend_activation.submit' => "Renvoyer le code d'activation",
    'resend_activation.success' => "Si un compte avec l'e-mail fourni existe et n'est pas activé, un nouvel e-mail d'activation a été envoyé. Veuillez consulter votre boîte de réception.",

    'activation.success' => "Votre compte a été activé avec succès. Vous pouvez maintenant <a href=\"{$app->url->route('users.login')}\">vous connecter</a>.",
    'activation.failed' => "L'activation du compte a échoué. Clé d'activation invalide ou expirée. Veuillez demander un nouvel e-mail d'activation à partir de la <a href=\"{$app->url->route('users.register.resend_activation')}\">page de renvoi d'activation</a>.",

    'err.username' => "Veuillez entrer le nom d'utilisateur",
    'err.username.invalid' => "Le nom d'utilisateur n'est pas valide. Il doit faire entre 5 et 100 caractères et ne peut contenir que des lettres, des chiffres, des traits de soulignement et des points.",
    'err.username.exists' => "Le nom d'utilisateur est déjà pris. Veuillez en choisir un autre.",
    'err.email' => "Veuillez entrer l'e-mail",
    'err.email.invalid' => "L'e-mail n'est pas valide",
    'err.email.exists' => "L'e-mail est déjà enregistré. Veuillez utiliser un e-mail différent.",
    'err.password' => "Veuillez entrer le mot de passe",
    'err.password.invalid' => "Le mot de passe n'est pas valide. Il doit faire entre 6 et 100 caractères et inclure un mélange de lettres, de chiffres et de caractères spéciaux.",
    'err.password.mismatch' => "Les mots de passe ne correspondent pas",
    'err.agreement' => "Vous devez accepter les termes et conditions d'inscription pour continuer",

    'err.activation.params' => "Paramètres d'activation invalides",
];
