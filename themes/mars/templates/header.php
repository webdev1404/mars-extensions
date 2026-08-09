<!doctype html>
<html lang="{! $theme->renderLang() !}">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
{! $theme->renderHead() !}
</head>

<body>
    <header>
        <span class="logo">{! $theme->renderSiteName() !}</span>
        <nav>
            {! $theme->renderMenu('main') !}
        </nav>
    </header>

<div id="page-header">
    {! $theme->renderHeading() !}
    {! $theme->renderBreadcrumbs() !}
</div>

{! $theme->renderAlerts() !}