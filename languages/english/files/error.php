<?php

return [
    'fatal.error' => 'A fatal error has occurred. Please contact the administrator.',
    'mail.send' => 'Error sending mail: {ERROR}',

    'file.invalid_chars' => 'Invalid filename! File {FILE} contains invalid characters!',
    'file.invalid_maxchars' => 'Invalid filename! File {FILE} contains invalid characters!',
    'file.invalid_basedir' => 'Invalid filename! Filename {FILE} is not inside the base dir!',
    'file.read' => 'Error reading file: {FILE}',
    'file.write' => 'Error writing file: {FILE}.',
    'file.delete' => 'Error deleting file {FILE}',
    'file.copy' => 'Error copying file {SOURCE} to {DESTINATION}',
    'file.move' => 'Error moving file {SOURCE} to {DESTINATION}',

    'dir.create' => 'Error creating folder: {DIR}',
    'dir.delete' => 'Error deleting folder: {DIR}',
    'dir.move' => 'Error moving folder {SOURCE} to {DESTINATION}',

    'upload.generic' => 'Error uploading file {FILE}',
    'upload.size' => 'Upload error. File too big! Max. filesize allowed: {SIZE}',
    'upload.partial' => 'Upload error. The uploaded file was only partially uploaded',
    'upload.nofile' => 'Upload error. No file was uploaded',
    'upload.tmp' => 'Upload error. Error writing the uploaded file to the tmp dir',
    'upload.invalid_type' => 'Upload error. Invalid file type for file: {FILE}. You are not allowed to upload files with this extension',

    'request.not_post' => 'Invalid request. The request method must be POST.',
    'request.invalid_csrf' => 'Invalid request. The CSRF token is invalid or has expired. Please try again.'
];
