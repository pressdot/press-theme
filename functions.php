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

function press_get_random_svg() {
    $colors = array('#0ea5e9', '#6366f1', '#8b5cf6', '#ec4899', '#10b981', '#f59e0b', '#3b82f6', '#8b5cf6');
    $bg_color = $colors[array_rand($colors)];
    $shape_color = $colors[array_rand($colors)];
    
    // Simple geometric pattern
    $svg = '<svg width="800" height="600" xmlns="http://www.w3.org/2000/svg">
        <rect width="100%" height="100%" fill="' . $bg_color . '"/>
        <circle cx="' . rand(100, 700) . '" cy="' . rand(100, 500) . '" r="' . rand(50, 300) . '" fill="' . $shape_color . '" fill-opacity="0.2"/>
        <rect x="' . rand(0, 600) . '" y="' . rand(0, 400) . '" width="' . rand(100, 400) . '" height="' . rand(100, 400) . '" fill="white" fill-opacity="0.1" transform="rotate(' . rand(0, 90) . ' ' . rand(300, 500) . ' ' . rand(200, 400) . ')"/>
        <text x="50%" y="50%" font-family="sans-serif" font-size="40" fill="white" fill-opacity="0.3" text-anchor="middle" dominant-baseline="middle">Press.</text>
    </svg>';
    
    return 'data:image/svg+xml;base64,' . base64_encode($svg);
}

