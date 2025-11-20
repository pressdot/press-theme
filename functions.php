<?php
function press_theme_scripts() {
    // Tailwind CSS (CDN for development speed/fidelity as requested)
    wp_enqueue_script('tailwind', 'https://cdn.tailwindcss.com', array(), null, false);
    
    // Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0');
    
    // Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+SC:wght@300;400;500;700&family=JetBrains+Mono:wght@400;700&display=swap', array(), null);
    
    // Theme Styles
    wp_enqueue_style('press-style', get_stylesheet_uri(), array(), '1.0');

    // GSAP
    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js', array(), '3.12.2', true);

    // Barba.js
    wp_enqueue_script('barba', 'https://unpkg.com/@barba/core', array('gsap'), '2.9.7', true);
    
    // Main JS
    wp_enqueue_script('press-main', get_template_directory_uri() . '/assets/js/main.js', array('barba'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'press_theme_scripts');

function press_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'press-theme'),
    ));
}
add_action('after_setup_theme', 'press_theme_setup');

// Fix for wp_nav_menu add_li_class argument
function press_nav_menu_css_class($classes, $item, $args) {
    if (isset($args->add_li_class)) {
        $classes[] = $args->add_li_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'press_nav_menu_css_class', 1, 3);

function press_widgets_init() {
    register_sidebar(array(
        'name'          => __('Main Sidebar', 'press-theme'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'press-theme'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8 bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title font-bold text-slate-900 dark:text-white mb-4 border-l-4 border-brand-500 pl-3">',
        'after_title'   => '</h3>',
    ));
}
add_action('widgets_init', 'press_widgets_init');

function press_theme_comment($comment, $args, $depth) {
    ?>
    <div <?php comment_class('flex mb-8'); ?> id="comment-<?php comment_ID(); ?>">
        <div class="flex-shrink-0 mr-4">
            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size'], '', '', array('class' => 'h-10 w-10 rounded-full bg-slate-200')); ?>
        </div>
        <div class="flex-grow">
            <div class="bg-white dark:bg-slate-800 p-4 rounded-2xl rounded-tl-none border border-slate-200 dark:border-slate-700 shadow-sm">
                <div class="flex justify-between items-center mb-2">
                    <h5 class="font-bold text-slate-900 dark:text-white text-sm">
                        <?php echo get_comment_author_link(); ?>
                        <?php if ($comment->user_id === get_the_author_meta('ID')) : ?>
                            <span class="ml-2 px-1.5 py-0.5 bg-brand-600 text-white text-[10px] rounded uppercase">Author</span>
                        <?php endif; ?>
                    </h5>
                    <span class="text-xs text-slate-400">
                        <?php printf(__('%1$s at %2$s'), get_comment_date(), get_comment_time()); ?>
                    </span>
                </div>

                <?php if ($comment->comment_approved == '0') : ?>
                    <em class="text-sm text-yellow-600 block mb-2"><?php _e('Your comment is awaiting moderation.', 'press-theme'); ?></em>
                <?php endif; ?>

                <div class="text-slate-600 dark:text-slate-300 text-sm comment-content">
                    <?php comment_text(); ?>
                </div>

                <div class="mt-3 flex items-center gap-4">
                    <?php
                    comment_reply_link(array_merge($args, array(
                        'add_below' => 'comment',
                        'depth'     => $depth,
                        'max_depth' => $args['max_depth'],
                        'before'    => '',
                        'after'     => '',
                        'reply_text' => '回复',
                        'class'     => 'text-xs text-slate-500 hover:text-brand-500 font-medium'
                    )));
                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

// Navigation Fallback
function press_nav_menu_fallback($args) {
    $class = 'text-slate-600 dark:text-slate-300 hover:text-brand-600 dark:hover:text-brand-400 font-medium px-3 py-2 transition';
    echo '<li class="' . $class . '"><a href="' . home_url() . '">首页</a></li>';
}

function press_get_random_svg() {
    // Tech/Finance Theme Colors
    $bg_colors = array('#0f172a', '#1e293b', '#172554', '#022c22'); // Dark Slate, Blue, Green
    $line_colors = array('#0ea5e9', '#10b981', '#6366f1', '#f59e0b'); // Sky, Emerald, Indigo, Amber
    
    $bg = $bg_colors[array_rand($bg_colors)];
    $line = $line_colors[array_rand($line_colors)];
    
    // Generate a random "chart" line
    $points = "0," . rand(300, 500);
    $step = 800 / 5;
    for ($i = 1; $i <= 5; $i++) {
        $points .= " " . ($i * $step) . "," . rand(100, 500);
    }
    
    $svg = '<svg width="800" height="600" xmlns="http://www.w3.org/2000/svg">
        <rect width="100%" height="100%" fill="' . $bg . '"/>
        <!-- Grid Lines -->
        <path d="M0 100 H800 M0 200 H800 M0 300 H800 M0 400 H800 M0 500 H800" stroke="white" stroke-opacity="0.05" stroke-width="1"/>
        <path d="M100 0 V600 M200 0 V600 M300 0 V600 M400 0 V600 M500 0 V600 M600 0 V600 M700 0 V600" stroke="white" stroke-opacity="0.05" stroke-width="1"/>
        
        <!-- Chart Line -->
        <polyline points="' . $points . '" fill="none" stroke="' . $line . '" stroke-width="4" stroke-opacity="0.8"/>
        
        <!-- Area under curve (simplified) -->
        <polygon points="0,600 ' . $points . ' 800,600" fill="' . $line . '" fill-opacity="0.1"/>
        
        <text x="40" y="560" font-family="monospace" font-size="24" fill="white" fill-opacity="0.4">PRESS.GY ANALYTICS</text>
    </svg>';
    
    return 'data:image/svg+xml;base64,' . base64_encode($svg);
}

// Customizer Settings
function press_customize_register($wp_customize) {
    $wp_customize->add_section('press_hero_section', array(
        'title' => __('Homepage Hero', 'press-theme'),
        'priority' => 30,
    ));

    // Hero Image
    $wp_customize->add_setting('press_hero_image');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'press_hero_image', array(
        'label' => __('Hero Background Image', 'press-theme'),
        'section' => 'press_hero_section',
        'settings' => 'press_hero_image',
    )));

    // Hero Title
    $wp_customize->add_setting('press_hero_title', array('default' => 'Welcome to Press.gy'));
    $wp_customize->add_control('press_hero_title', array(
        'label' => __('Hero Title', 'press-theme'),
        'section' => 'press_hero_section',
        'type' => 'text',
    ));

    // Hero Text
    $wp_customize->add_setting('press_hero_text', array('default' => 'Exploring the future of tech and finance.'));
    $wp_customize->add_control('press_hero_text', array(
        'label' => __('Hero Text', 'press-theme'),
        'section' => 'press_hero_section',
        'type' => 'textarea',
    ));

    // Default Post Thumbnail
    $wp_customize->add_section('press_general_section', array(
        'title' => __('General Settings', 'press-theme'),
        'priority' => 20,
    ));
    $wp_customize->add_setting('press_default_thumbnail');
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'press_default_thumbnail', array(
        'label' => __('Default Post Thumbnail', 'press-theme'),
        'description' => __('Used when a post has no featured image.', 'press-theme'),
        'section' => 'press_general_section',
        'settings' => 'press_default_thumbnail',
    )));
}
add_action('customize_register', 'press_customize_register');

// Helper: Get Post Thumbnail URL with Fallback
function press_get_post_thumbnail_url($post_id, $size = 'full') {
    // 1. Check for Featured Image
    $thumb_url = get_the_post_thumbnail_url($post_id, $size);
    
    // 2. Check for Customizer Default Image
    if (!$thumb_url) {
        $thumb_url = get_theme_mod('press_default_thumbnail');
    }
    
    // 3. Fallback to SVG
    if (!$thumb_url) {
        $thumb_url = press_get_random_svg();
    }
    
    return $thumb_url;
}
