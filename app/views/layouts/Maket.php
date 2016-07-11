<?php
use Micro\Web\Html\Html;

Html::doctype('html5');
?>
<html>
    <head>
        <meta charset="utf-8"/>
        <link href="/main.css"  rel="stylesheet" />
    </head>
    <body>
        <div class="container">
            <?=$content?>
        </div>
    </body>
</html>