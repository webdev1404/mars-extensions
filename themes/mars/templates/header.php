<!doctype html>
<html lang="{! $theme.outputLang() !}">
<head>
{! $theme.outputHead() !}
</head>

<body>
    <header>
        <span class="logo">{{ $config.site_name }}</span>
        @template ('menu')
    </header>

{! $theme.outputAlerts() !}