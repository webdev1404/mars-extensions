<?php

return [
    'fatal.error' => 'Une erreur fatale s\'est produite. Veuillez contacter l\'administrateur.',
    'mail.send' => 'Erreur lors de l\'envoi du mail : {ERROR}',

    'file.invalid_chars' => 'Nom de fichier invalide ! Le fichier {FILE} contient des caractères invalides !',
    'file.invalid_maxchars' => 'Nom de fichier invalide ! Le fichier {FILE} contient trop de caractères !',
    'file.invalid_basedir' => 'Nom de fichier invalide ! Le fichier {FILE} n\'est pas dans le répertoire de base !',
    'file.read' => 'Erreur lors de la lecture du fichier : {FILE}',
    'file.write' => 'Erreur lors de l\'écriture du fichier : {FILE}.',
    'file.delete' => 'Erreur lors de la suppression du fichier {FILE}',
    'file.copy' => 'Erreur lors de la copie du fichier {SOURCE} vers {DESTINATION}',
    'file.move' => 'Erreur lors du déplacement du fichier {SOURCE} vers {DESTINATION}',

    'dir.create' => 'Erreur lors de la création du dossier : {DIR}',
    'dir.delete' => 'Erreur lors de la suppression du dossier : {DIR}',
    'dir.move' => 'Erreur lors du déplacement du dossier {SOURCE} vers {DESTINATION}',

    'upload.generic' => 'Erreur lors du téléchargement du fichier {FILE}',
    'upload.size' => 'Erreur de téléchargement. Le fichier est trop volumineux ! Taille maximale autorisée : {SIZE}',
    'upload.partial' => 'Erreur de téléchargement. Le fichier n\'a été que partiellement téléchargé',
    'upload.nofile' => 'Erreur de téléchargement. Aucun fichier n\'a été téléchargé',
    'upload.tmp' => 'Erreur de téléchargement. Erreur lors de l\'écriture du fichier téléchargé dans le répertoire temporaire',
    'upload.invalid_type' => 'Erreur de téléchargement. Type de fichier invalide pour le fichier : {FILE}. Vous n\'êtes pas autorisé à télécharger des fichiers avec cette extension',

    'request.not_post' => 'Requête invalide. La méthode de requête doit être POST.',
    'request.invalid_csrf' => 'Requête invalide. Le jeton CSRF est invalide ou a expiré. Veuillez réessayer.'
];
