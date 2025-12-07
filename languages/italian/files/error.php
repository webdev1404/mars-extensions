<?php

return [
    'fatal.error' => 'Si è verificato un errore fatale. Si prega di contattare l\'amministratore.',
    'mail.send' => 'Errore nell\'invio della mail: {ERROR}',

    'file.invalid_chars' => 'Nome file non valido! Il file {FILE} contiene caratteri non validi!',
    'file.invalid_maxchars' => 'Nome file non valido! Il file {FILE} contiene troppi caratteri!',
    'file.invalid_basedir' => 'Nome file non valido! Il file {FILE} non si trova nella directory di base!',
    'file.read' => 'Errore nella lettura del file: {FILE}',
    'file.write' => 'Errore nella scrittura del file: {FILE}.',
    'file.delete' => 'Errore nell\'eliminazione del file {FILE}',
    'file.copy' => 'Errore nella copia del file {SOURCE} in {DESTINATION}',
    'file.move' => 'Errore nello spostamento del file {SOURCE} in {DESTINATION}',

    'dir.create' => 'Errore nella creazione della cartella: {DIR}',
    'dir.delete' => 'Errore nell\'eliminazione della cartella: {DIR}',
    'dir.move' => 'Errore nello spostamento della cartella {SOURCE} in {DESTINATION}',

    'upload.generic' => 'Errore durante il caricamento del file {FILE}',
    'upload.size' => 'Errore di caricamento. File troppo grande! Dimensione massima consentita: {SIZE}',
    'upload.partial' => 'Errore di caricamento. Il file è stato caricato solo parzialmente',
    'upload.nofile' => 'Errore di caricamento. Nessun file è stato caricato',
    'upload.tmp' => 'Errore di caricamento. Errore nella scrittura del file caricato nella directory temporanea',
    'upload.invalid_type' => 'Errore di caricamento. Tipo di file non valido per il file: {FILE}. Non è consentito caricare file con questa estensione',

    'request.not_post' => 'Richiesta non valida. Il metodo della richiesta deve essere POST.',
    'request.invalid_csrf' => 'Richiesta non valida. Il token CSRF non è valido o è scaduto. Si prega di riprovare.'
];
