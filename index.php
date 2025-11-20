<?php get_header(); ?>

<!-- VIEW: HOME -->
<div id="view-home" class="view-section active">
    <!-- Hero Section: Featured Post -->
    <?php
    $sticky = get_option('sticky_posts');
    $args = array(
        'posts_per_page' => 1,
        'post__in' => $sticky,
        'ignore_sticky_posts' => 1
    );
    $hero_query = new WP_Query($args);
    
    if ($hero_query->have_posts() && !empty($sticky)) :
        while ($hero_query->have_posts()) : $hero_query->the_post();
            $thumb_url = press_get_post_thumbnail_url(get_the_ID(), 'full');
    ?>
    <div class="relative bg-slate-100 dark:bg-slate-800 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 to-transparent z-10"></div>
            <div class="w-full h-full bg-cover bg-center opacity-40" style="background-image: url('<?php echo esc_attr($thumb_url); ?>');"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 py-20 sm:py-24">
            <div class="lg:w-2/3">
                <div class="inline-flex items-center px-3 py-1 rounded-full border border-yellow-500/30 bg-yellow-500/10 text-yellow-500 text-xs font-semibold tracking-wide uppercase mb-4 backdrop-blur-sm">
                    <i class="fab fa-bitcoin mr-2"></i> 深度好文
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                    <a href="<?php the_permalink(); ?>" class="hover:text-brand-400 transition"><?php the_title(); ?></a>
                </h1>
                <div class="text-lg text-slate-300 mb-8 max-w-2xl leading-relaxed line-clamp-2">
                    <?php the_excerpt(); ?>
                </div>
                <div class="flex flex-wrap gap-4">
                    <a href="<?php the_permalink(); ?>" class="bg-white text-slate-900 hover:bg-slate-100 px-6 py-3 rounded-lg font-semibold transition flex items-center cursor-pointer">
                        阅读全文 <i class="fas fa-arrow-right ml-2 text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <?php
        endwhile;
        wp_reset_postdata();
    else :
        // Customizer Fallback
        $hero_bg = get_theme_mod('press_hero_image', press_get_random_svg());
        $hero_title = get_theme_mod('press_hero_title', 'Welcome to Press.gy');
        $hero_text = get_theme_mod('press_hero_text', 'Exploring the future of tech and finance.');
    ?>
    <div class="relative bg-slate-100 dark:bg-slate-800 overflow-hidden">
        <div class="absolute inset-0">
            <div class="absolute inset-0 bg-gradient-to-r from-slate-900 to-transparent z-10"></div>
            <div class="w-full h-full bg-cover bg-center opacity-40" style="background-image: url('<?php echo esc_attr($hero_bg); ?>');"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-20 py-20 sm:py-24">
            <div class="lg:w-2/3">
                <h1 class="text-4xl sm:text-5xl font-extrabold text-white tracking-tight mb-6 leading-tight">
                    <?php echo esc_html($hero_title); ?>
                </h1>
                <div class="text-lg text-slate-300 mb-8 max-w-2xl leading-relaxed">
                    <?php echo esc_html($hero_text); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
    endif;
    ?>

    <!-- Home Content Area -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            
            <!-- Left Column: Latest Posts (8 cols) -->
            <div class="lg:col-span-8 space-y-10">
                
                <div class="flex justify-between items-end border-b border-slate-200 dark:border-slate-700 pb-4 mb-6">
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center">
                        <i class="fas fa-layer-group text-brand-500 mr-2"></i> 最新文章
                    </h2>
                    <a href="<?php echo get_post_type_archive_link('post'); ?>" class="text-sm text-brand-600 dark:text-brand-400 hover:underline">查看归档 -></a>
                </div>

                <?php
                if (have_posts()) :
                    while (have_posts()) : the_post();
                        $thumb_url = press_get_post_thumbnail_url(get_the_ID(), 'large');
                ?>
                <!-- Article Card -->
                <article class="card-hover-effect group bg-white dark:bg-slate-800 rounded-2xl shadow-sm transition duration-300 border border-slate-200 dark:border-slate-700 overflow-hidden flex flex-col sm:flex-row">
                    <div class="sm:w-1/3 h-48 sm:h-auto relative overflow-hidden">
                            <div class="absolute inset-0 bg-indigo-900/20 group-hover:bg-transparent transition z-10"></div>
                            <img src="<?php echo esc_attr($thumb_url); ?>" alt="<?php the_title(); ?>" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
                    </div>
                    <div class="p-6 sm:w-2/3 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2 mb-3 text-xs font-medium">
                                <?php
                                $cats = get_the_category();
                                if ($cats) {
                                    echo '<span class="text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20 px-2 py-1 rounded">' . $cats[0]->name . '</span>';
                                }
                                ?>
                                <span class="text-slate-400"><i class="far fa-clock mr-1"></i> <?php echo get_the_date(); ?></span>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 group-hover:text-brand-500 transition">
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h3>
                            <div class="text-slate-600 dark:text-slate-400 text-sm leading-relaxed line-clamp-2">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <div class="flex items-center text-sm text-slate-500">
                                <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', array('class' => 'w-6 h-6 rounded-full mr-2')); ?>
                                <span><?php the_author(); ?></span>
                            </div>
                            <div class="flex items-center gap-4 text-xs text-slate-400">
                                <span class="flex items-center" title="阅读量">
                                    <i class="far fa-eye mr-1"></i> <?php echo (int) get_post_meta(get_the_ID(), 'views', true); ?>
                                </span>
                                <span class="flex items-center" title="评论数">
                                    <i class="far fa-comment mr-1"></i> <?php echo get_comments_number(); ?>
                                </span>
                                <span class="flex items-center" title="点赞">
                                    <i class="far fa-heart mr-1"></i> <?php echo (int) get_post_meta(get_the_ID(), 'likes', true); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
                <?php
                    endwhile;
                    
                    // Pagination
                    the_posts_pagination(array(
                        'mid_size'  => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i>',
                        'next_text' => '<i class="fas fa-chevron-right"></i>',
                        'class'     => 'flex justify-center pt-6'
                    ));
                    
                else :
                    echo '<p>No posts found.</p>';
                endif;
                ?>

            </div>

            <!-- Sidebar -->
            <?php get_sidebar(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
