<!DOCTYPE html>
<html>
    <head>
        <title>Check Server | Wing Framework</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset='UTF-8'>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <link rel="icon" type="image/png" href="img/logo-lodge-fav.png" />

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="page-header">
                <h2>Check requirement's</h2>
            </div>
            <?php
            $requirements = array();
            $requirements[] = array(
                "setting" => "PHP version",
                "requirement" => "&lt; 5.3",
                "status" => (version_compare(phpversion(), '5.3.10', '>')),
                "description" => "",
            );
            $requirements[] = array(
                "setting" => "Rewrite Module",
                "requirement" => "mod_rewrite enabled",
                "status" => (function_exists('apache_get_modules') && in_array('mod_rewrite', apache_get_modules())),
                "description" => "",
            );
            $requirements[] = array(
                "setting" => "PDO module",
                "requirement" => "pdo_mysql",
                "status" => (defined('PDO::ATTR_DRIVER_NAME')),
                "description" => "",
            );
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Setting</th>
                        <th>Requirement</th>
                        <th>Status</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($requirements as $req): ?>
                        <tr>
                            <td><?= $req["setting"] ?></td>
                            <td><?= $req["requirement"] ?></td>
                            <?php if ($req["status"]): ?>
                                <td class="success"><i class="glyphicon glyphicon-ok"></i></td>
                            <?php else: ?>
                                <td class="danger"><i class="glyphicon glyphicon-ban-circle"></i></td>
                                <?php endif; ?>
                            <td><?= $req["description"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </body>
</html>