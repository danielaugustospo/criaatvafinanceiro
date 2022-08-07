<html lang="<?php echo e(app()->getLocale()); ?>">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/img/favicon.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'Gerenciamento Financeiro - Criaatva')); ?></title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" />

    <?php echo $__env->make('layouts/include', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts/scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('layouts/estilo', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

</head>



<body style="background-image: url('<?php echo e(config('app.url')); ?>/img/BACKGROUND-TOP.jpg');">
    <div id="app">
        <?php if(isset($paginaModal)): ?>
        <?php else: ?>
            <?php echo $__env->make('layouts/navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
        <main class="py-4" style="margin-bottom: 50px;">
            <div class="m-2 justify-content-center">
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>
    <?php if(isset($paginaModal)): ?>
    <?php else: ?>
        <div class="footer fixed-bottom" style="background-color: black;">
            <p class="text-center text-primary"><small>Desenvolvido por DanielTECH -
                <?php function getVersion(){  $hash = exec("git rev-list --tags --max-count=1"); return exec("git describe --tags $hash"); } echo getVersion(); ?>
            </small></p>
        </div>
    <?php endif; ?>
</body>

</html>
<?php /**PATH /var/www/clients/client2/web4/web/resources/views/layouts/app.blade.php ENDPATH**/ ?>