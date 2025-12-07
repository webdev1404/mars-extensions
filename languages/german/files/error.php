<?php

return [
    'fatal.error' => 'Ein schwerwiegender Fehler ist aufgetreten. Bitte kontaktieren Sie den Administrator.',
    'mail.send' => 'Fehler beim Senden der E-Mail: {ERROR}',

    'file.invalid_chars' => 'Ungültiger Dateiname! Die Datei {FILE} enthält ungültige Zeichen!',
    'file.invalid_maxchars' => 'Ungültiger Dateiname! Die Datei {FILE} enthält zu viele Zeichen!',
    'file.invalid_basedir' => 'Ungültiger Dateiname! Die Datei {FILE} befindet sich nicht im Basisverzeichnis!',
    'file.read' => 'Fehler beim Lesen der Datei: {FILE}',
    'file.write' => 'Fehler beim Schreiben der Datei: {FILE}.',
    'file.delete' => 'Fehler beim Löschen der Datei {FILE}',
    'file.copy' => 'Fehler beim Kopieren der Datei {SOURCE} nach {DESTINATION}',
    'file.move' => 'Fehler beim Verschieben der Datei {SOURCE} nach {DESTINATION}',

    'dir.create' => 'Fehler beim Erstellen des Ordners: {DIR}',
    'dir.delete' => 'Fehler beim Löschen des Ordners: {DIR}',
    'dir.move' => 'Fehler beim Verschieben des Ordners {SOURCE} nach {DESTINATION}',

    'upload.generic' => 'Fehler beim Hochladen der Datei {FILE}',
    'upload.size' => 'Fehler beim Hochladen. Die Datei ist zu groß! Maximal erlaubte Dateigröße: {SIZE}',
    'upload.partial' => 'Fehler beim Hochladen. Die Datei wurde nur teilweise hochgeladen',
    'upload.nofile' => 'Fehler beim Hochladen. Es wurde keine Datei hochgeladen',
    'upload.tmp' => 'Fehler beim Hochladen. Fehler beim Schreiben der hochgeladenen Datei in das temporäre Verzeichnis',
    'upload.invalid_type' => 'Fehler beim Hochladen. Ungültiger Dateityp für die Datei: {FILE}. Sie dürfen keine Dateien mit dieser Erweiterung hochladen',

    'request.not_post' => 'Ungültige Anfrage. Die Anfragemethode muss POST sein.',
    'request.invalid_csrf' => 'Ungültige Anfrage. Das CSRF-Token ist ungültig oder abgelaufen. Bitte versuchen Sie es erneut.'
];
