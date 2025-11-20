<!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Noto Sans SC"', 'sans-serif'],
                        mono: ['"JetBrains Mono"', 'monospace'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            500: '#0ea5e9', // Sky blue for tech
                            600: '#0284c7',
                            900: '#0c4a6e',
                        },
                        crypto: {
                            btc: '#f7931a',
                            eth: '#627eea',
                        }
                    },
                    typography: (theme) => ({
                        DEFAULT: {
                            css: {
                                color: theme('colors.slate.700'),
                                a: {
                                    color: theme('colors.brand.600'),
                                    '&:hover': {
                                        color: theme('colors.brand.500'),
                                    },
                                },
                            },
                        },
                        dark: {
                            css: {
                                color: theme('colors.slate.300'),
                                a: {
                                    color: theme('colors.brand.400'),
                                    '&:hover': {
                                        color: theme('colors.brand.300'),
                                    },
                                },
                                h1: { color: theme('colors.white') },
                                h2: { color: theme('colors.white') },
                                h3: { color: theme('colors.white') },
                                strong: { color: theme('colors.white') },
                                code: { color: theme('colors.brand.300') },
                                blockquote: { borderLeftColor: theme('colors.brand.500') },
                            },
                        },
                    }),
                }
            }
        }
    </script>
</head>
<body <?php body_class('bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-200 font-sans antialiased transition-colors duration-300 selection:bg-brand-500 selection:text-white'); ?>>

    <!-- Top Ticker (Investment Focus) -->
    <div class="ticker-wrap border-b border-slate-800 text-xs font-mono tracking-wide z-50 relative">
        <div class="ticker">
            <span class="mx-4 text-green-400"><i class="fab fa-bitcoin text-crypto-btc mr-1"></i>BTC $98,234.50 (+3.2%)</span>
            <span class="mx-4 text-blue-400"><i class="fab fa-ethereum text-crypto-eth mr-1"></i>ETH $3,450.12 (+1.5%)</span>
            <span class="mx-4 text-red-400"><i class="fas fa-chart-line mr-1"></i>NVDA $145.20 (-0.8%)</span>
            <span class="mx-4 text-green-400"><i class="fas fa-dollar-sign mr-1"></i>QQQ $480.50 (+0.5%)</span>
            <span class="mx-4 text-slate-400">| 距离下一次减半还有 1,240 天</span>
            <span class="mx-4 text-brand-500">今日代办: 修复 Zigbee 串口通讯 Bug...</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="sticky top-0 z-40 bg-white/80 dark:bg-slate-900/90 backdrop-blur-md border-b border-slate-200 dark:border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <!-- Logo -->
                <a href="<?php echo home_url(); ?>" class="flex-shrink-0 flex items-center cursor-pointer">
                    <div class="text-2xl font-bold tracking-tighter text-slate-900 dark:text-white flex items-center gap-2">
                        <span class="bg-brand-600 text-white w-8 h-8 rounded-lg flex items-center justify-center text-lg">P</span>
                        <span>Press<span class="text-brand-500">.</span>gy</span>
                    </div>
                </a>

                <!-- Desktop Menu -->
                <div class="hidden md:flex space-x-8">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'menu_class' => 'flex space-x-8',
                        'items_wrap' => '%3$s',
                        'add_li_class'  => 'text-slate-600 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 font-medium px-3 py-2 transition'
                    ));
                    ?>
                </div>

                <!-- Actions -->
                <div class="flex items-center space-x-4">
                    <button class="p-2 text-slate-500 hover:text-brand-600 transition">
                        <i class="fas fa-search"></i>
                    </button>
                    <button id="theme-toggle" class="p-2 text-slate-500 hover:text-yellow-500 transition">
                        <i class="fas fa-moon dark:hidden"></i>
                        <i class="fas fa-sun hidden dark:block"></i>
                    </button>
                    <a href="<?php bloginfo('rss2_url'); ?>" class="hidden sm:block bg-brand-600 hover:bg-brand-700 text-white px-4 py-2 rounded-full text-sm font-medium transition shadow-lg shadow-brand-500/30">
                        订阅 RSS
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Layout Wrapper -->
    <main id="barba-wrapper">
        <?php
            $ns = 'home';
            if (is_single()) {
                $ns = 'single';
            } elseif (is_page()) {
                $ns = 'page';
            } elseif (is_404()) {
                $ns = '404';
            }
        ?>
        <div class="barba-container" data-barba="container" data-barba-namespace="<?php echo esc_attr($ns); ?>">
