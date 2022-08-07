<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo e(env('APP_NAME')); ?></title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: black;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <?php if(Route::has('login')): ?>
                <div class="top-right links">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(url('/home')); ?>">Home</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>">Login</a>

                        <?php if(Route::has('register')): ?>
                            <!-- <a href="<?php echo e(route('register')); ?>">Register</a> -->
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="content">
            <div class="title m-b-md">
            <a href="<?php echo e(route('login')); ?>"><img src="./img/logo-criaatvaPRETOWHITE.png" style="width: 20%;"> </a>       
            
            <!-- Criaatva -->
                </div>

                <div class="links">
                    <a href="https://criaatva.com/criaatva/" target="_blank">Acessar Site Principal</a>
                    <a href="<?php echo e(route('login')); ?>" target="_blank">Login</a>
                    <a href="https://www.instagram.com/criaatva" target="_blank">Instagram</a>
                    <a href="https://www.facebook.com/criaatva/" target="_blank">Facebook</a>

                    <a href="https://danieltecnologia.com" target="_blank">Suporte</a>
                </div>
        </div>
    </body>
</html>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/welcome.blade.php ENDPATH**/ ?>