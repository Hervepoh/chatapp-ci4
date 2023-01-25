<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ci4 Websocket chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
</head>

<body>

    <?php $uri = service('uri'); ?>

    <nav class="navbar navbar-expand-lg  navbar-dark bg-dark text-white">
        <div class="container">
            <a class="navbar-brand" href="<?= url_to('home') ?>">Ci4 Social</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if (session()->get('isLoggedIn')) : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'dashboard') ? 'active' : null ?>" href="<?= url_to('dashboard') ?>">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri->getSegment(1) == '') ? 'active' : null ?>" href="<?= url_to('home') ?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  <?= ($uri->getSegment(1) == 'chat') ? 'active' : null ?>" href="<?= url_to('chat') ?>">chat</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  <?= ($uri->getSegment(1) == 'profile') ? 'active' : null ?>" href="<?= url_to('profile') ?>">Profile</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav  justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'logout') ? 'active' : null ?>" href="/logout">Logout</a>
                        </li>
                    </ul>
                <?php else : ?>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'login') ? 'active' : null ?>" href="<?= url_to('login') ?>">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?= ($uri->getSegment(1) == 'register') ? 'active' : null ?>" href="<?= url_to('register') ?>">Register</a>
                        </li>
                    </ul>

                <?php endif; ?>
            </div>
        </div>
    </nav>