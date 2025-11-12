<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" class="dark">
    <head>
        <meta name="mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="application-name" content="Nome do Seu Site">
        <link rel="icon" type="image/png" sizes="192x192" href="/img/icon.png"> <!-- ícone para Android -->
        <link rel="apple-touch-icon" href="/img/icon.png"> <!-- ícone para iOS -->
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <?php $setting = \Helper::getSetting() ?>
        <?php if(!empty($setting['software_favicon'])): ?>
            <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('/storage/' . $setting['software_favicon'])); ?>">
        <?php endif; ?>

        <link rel="stylesheet" href="<?php echo e(asset('assets/css/fontawesome.min.css')); ?>">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700&family=Roboto+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100&display=swap" rel="stylesheet">        
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">


        <title><?php echo e(env('APP_NAME')); ?></title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <?php $custom = \Helper::getCustom() ?>
        <style>
            body{
                /* font-family: "'Roboto', sans-serif"; */
                 font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif; 
            }
            :root {
                --ci-primary-color: <?php echo e($custom['primary_color']); ?>;
                --ci-primary-opacity-color: <?php echo e($custom['primary_opacity_color']); ?>;
                --ci-secundary-color: <?php echo e($custom['secundary_color']); ?>;
                --ci-gray-dark: <?php echo e($custom['gray_dark_color']); ?>;
                --ci-gray-light: <?php echo e($custom['gray_light_color']); ?>;
                --ci-gray-medium: <?php echo e($custom['gray_medium_color']); ?>;
                --ci-gray-over: <?php echo e($custom['gray_over_color']); ?>;
                --title-color: <?php echo e($custom['title_color']); ?>;
                --text-color: <?php echo e($custom['text_color']); ?>;
                --sub-text-color: <?php echo e($custom['sub_text_color']); ?>;
                --placeholder-color: <?php echo e($custom['placeholder_color']); ?>;
                --background-color: <?php echo e($custom['background_color']); ?>;
                --standard-color: #1C1E22;
                --shadow-color: #111415;
                --page-shadow: linear-gradient(to right, #111415, rgba(17, 20, 21, 0));
                --autofill-color: #f5f6f7;
                --yellow-color: #FFBF39;
                --yellow-dark-color: #d7a026;
                --border-radius: <?php echo e($custom['border_radius']); ?>;
                --tw-border-spacing-x: 0;
                --tw-border-spacing-y: 0;
                --tw-translate-x: 0;
                --tw-translate-y: 0;
                --tw-rotate: 0;
                --tw-skew-x: 0;
                --tw-skew-y: 0;
                --tw-scale-x: 1;
                --tw-scale-y: 1;
                --tw-scroll-snap-strictness: proximity;
                --tw-ring-offset-width: 0px;
                --tw-ring-offset-color: #fff;
                --tw-ring-color: rgba(59,130,246,.5);
                --tw-ring-offset-shadow: 0 0 #0000;
                --tw-ring-shadow: 0 0 #0000;
                --tw-shadow: 0 0 #0000;
                --tw-shadow-colored: 0 0 #0000;

                --input-primary: <?php echo e($custom['input_primary']); ?>;
                --input-primary-dark: <?php echo e($custom['input_primary_dark']); ?>;

                --carousel-banners: <?php echo e($custom['carousel_banners']); ?>;
                --carousel-banners-dark: <?php echo e($custom['carousel_banners_dark']); ?>;


                --sidebar-color: <?php echo e($custom['sidebar_color']); ?> !important;
                --sidebar-color-dark: <?php echo e($custom['sidebar_color_dark']); ?> !important;


                --navtop-color <?php echo e($custom['navtop_color']); ?>;
                --navtop-color-dark: <?php echo e($custom['navtop_color_dark']); ?>;


                --side-menu <?php echo e($custom['side_menu']); ?>;
                --side-menu-dark: <?php echo e($custom['side_menu_dark']); ?>;

                --footer-color <?php echo e($custom['footer_color']); ?>;
                --footer-color-dark: <?php echo e($custom['footer_color_dark']); ?>;

                --card-color <?php echo e($custom['card_color']); ?>;
                --card-color-dark: <?php echo e($custom['card_color_dark']); ?>;
            }
            .navtop-color{
                background-color: <?php echo e($custom['sidebar_color']); ?> !important;
            }
            :is(.dark .navtop-color) {
                background-color: <?php echo e($custom['sidebar_color_dark']); ?> !important;
            }

            .bg-base {
                background-color: <?php echo e($custom['background_base']); ?>;
            }
            :is(.dark .bg-base) {
                background-color: <?php echo e($custom['background_base_dark']); ?>;
            }
        </style>

        <?php if(!empty($custom['custom_css'])): ?>
            <style>
                <?php echo $custom['custom_css']; ?>

            </style>
        <?php endif; ?>

        <?php if(!empty($custom['custom_header'])): ?>
            <?php echo $custom['custom_header']; ?>

        <?php endif; ?>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body color-theme="dark" class="bg-base text-gray-800 dark:text-gray-300 ">
        <div id="viperpro"></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/datepicker.min.js"></script>
        <script>
            window.Livewire?.on('copiado', (texto) => {
                navigator.clipboard.writeText(texto).then(() => {
                    Livewire.emit('copiado');
                });
            });

            window._token = '<?php echo e(csrf_token()); ?>';
            //if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            if (localStorage.getItem('color-theme') === 'light') {
                document.documentElement.classList.remove('dark')
                document.documentElement.classList.add('light');
            } else {
                document.documentElement.classList.remove('light')
                document.documentElement.classList.add('dark')
            }
        </script>
        <!-- Elfsight Telegram Chat | Untitled Telegram Chat 2 -->
        <script src="https://static.elfsight.com/platform/platform.js" async></script>
        <div class="elfsight-app-7f920811-48cf-4907-8dd3-561423cfa413" data-elfsight-app-lazy></div>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.0.0/datepicker.min.js"></script>
        <?php if(!empty($custom['custom_js'])): ?>
            <script>
                <?php echo $custom['custom_js']; ?>

            </script>
        <?php endif; ?>

        <?php if(!empty($custom['custom_body'])): ?>
            <?php echo $custom['custom_body']; ?>

        <?php endif; ?>

        <?php if(!empty($custom)): ?>
            <script>
                const custom = <?php echo json_encode($custom); ?>;
            </script>
        <?php endif; ?>
    </body>
</html>
<?php /**PATH /Users/everybecch/Downloads/CASSINOS/CACTUS-ROYALGAMES/resources/views/layouts/app.blade.php ENDPATH**/ ?>