<?php get_header(); ?>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="lg:grid lg:grid-cols-12 lg:gap-8">
        
        <!-- Left Column: Search Results (8 cols) -->
        <div class="lg:col-span-8 space-y-10">
            
            <div class="border-b border-slate-200 dark:border-slate-700 pb-4 mb-6">
                <h1 class="text-2xl font-bold text-slate-900 dark:text-white flex items-center">
                    <i class="fas fa-search text-brand-500 mr-2"></i> 
                    搜索结果: "<?php echo get_search_query(); ?>"
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-2">
                    共找到 <?php echo $wp_query->found_posts; ?> 篇文章
                </p>
            </div>

            <?php
            if (have_posts()) :
                while (have_posts()) : the_post();
                    $thumb_url = press_get_post_thumbnail_url(get_the_ID(), 'large');
            ?>
            <!-- Article Card -->
            <article class="card-hover-effect group bg-white dark:bg-slate-800 rounded-2xl shadow-sm transition duration-300 border border-slate-200 dark:border-slate-700 overflow-hidden flex flex-col sm:flex-row">
                <div class="sm:w-1/3 h-48 sm:h-full min-h-[200px] relative overflow-hidden">
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
            ?>
                <div class="text-center py-20 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700">
                    <div class="text-6xl mb-4 text-slate-200 dark:text-slate-700">
                        <i class="fas fa-search"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">未找到相关内容</h2>
                    <p class="text-slate-500 dark:text-slate-400 mb-8">尝试更换关键词再次搜索</p>
                    <div class="max-w-md mx-auto px-4">
                        <?php get_search_form(); ?>
                    </div>
                </div>
            <?php
            endif;
            ?>

        </div>

        <!-- Sidebar -->
        <?php get_sidebar(); ?>

    </div>
</div>

<?php get_footer(); ?>
