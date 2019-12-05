<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <style>
            body {
                padding-top: 20px;
            }
        </style>

        <?php if ($title): ?>
            <title><?=$this->e($title)?></title>
        <?php else: ?>
            <title>Linkers!</title>
        <?php endif ?>
    </head>
    <body>
        <div class="container">
            <?=$this->section('content')?>
        </div>
    </body>
</html>
