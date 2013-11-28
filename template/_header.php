<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correction A3</title>
    <link href="template/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="template/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css">
    <link href="template/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">A3 Correction</a>
            </div>

            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <?php if ($userSession->isConnected()) { ?>
                        <?php if ($userSession->hasRole('ROLE_ADMIN')) { ?>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Article <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="index.php">List articles</a></li>
                                    <li><a href="admin-article-add.php">Add an article</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Comment <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="admin-comment-list.php">List comments</a></li>
                                    <li><a href="admin-comment-add.php">Add a comment</a></li>
                                </ul>
                            </li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">User <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="admin-user-list.php">List users</a></li>
                                    <li><a href="admin-user-add.php">Add an user</a></li>
                                </ul>
                            </li>
                        <?php } else { ?>
                            <li><a href="index.php">Articles</a></li>
                            <li><a href="admin-comment-add.php">Add a comment</a></li>
                        <?php } ?>
                    <?php } else { ?>
                        <li><a href="index.php">Homepage</a></li>
                    <?php } ?>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <?php if (!$userSession->isConnected()): ?>
                        <li><a href="sign-up.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                        <li><a href="sign-in.php"><span class="glyphicon glyphicon-log-in"></span> Sign In</a></li>
                    <?php else: ?>
                        <li><a href="#">Welcome <?= $userSession->getUser()->getName(); ?></a></li>
                        <li><a href="sign-out.php"><span class="glyphicon glyphicon-log-out"></span> Sign Out</a></li>
                    <?php endif; ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
        <?php
            if (!empty($_SESSION['flash_messages'])) {
                foreach ($_SESSION['flash_messages'] as $key => $flash_message) {
                ?>
                    <div class="alert alert-<?= $flash_message['type'] ?> alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <?php if (!empty($flash_message['title'])) { ?>
                            <strong><?= $flash_message['title']; ?></strong>
                            <?= $flash_message['msg']; ?>
                        <?php } ?>
                    </div>
                <?php
                    unset($_SESSION['flash_messages'][$key]);
                }
            }
        ?>