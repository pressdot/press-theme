<?php get_header(); ?>

<!-- VIEW: SINGLE POST -->
<div id="view-single" class="view-section active">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            
            <!-- Left Column: Post Content -->
            <div class="lg:col-span-8">
                <?php
                while (have_posts()) : the_post();
                ?>
                <!-- Breadcrumb -->
                <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-6" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="<?php echo home_url(); ?>" class="hover:text-brand-500">首页</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li><?php the_category(', '); ?></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li class="text-slate-900 dark:text-slate-200 font-medium">正文</li>
                    </ol>
                </nav>

                <!-- Article Content -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <!-- Article Header -->
                    <header class="p-8 border-b border-slate-100 dark:border-slate-700/50">
                        <div class="flex items-center gap-2 mb-4">
                            <?php
                            $cats = get_the_category();
                            if ($cats) {
                                echo '<span class="text-purple-600 dark:text-purple-400 bg-purple-50 dark:bg-purple-900/20 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">' . $cats[0]->name . '</span>';
                            }
                            ?>
                            <span class="text-slate-400 text-xs flex items-center"><i class="fas fa-calendar-alt mr-1"></i> <?php echo get_the_date(); ?></span>
                            <span class="text-slate-400 text-xs flex items-center"><i class="fas fa-eye mr-1"></i> <?php echo (int) get_post_meta(get_the_ID(), 'views', true); ?> 次阅读</span>
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-6 leading-tight">
                            <?php the_title(); ?>
                        </h1>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <?php echo get_avatar(get_the_author_meta('ID'), 40, '', '', array('class' => 'w-10 h-10 rounded-full mr-3 border-2 border-white dark:border-slate-700')); ?>
                                <div>
                                    <p class="text-sm font-bold text-slate-900 dark:text-white"><?php the_author(); ?></p>
                                    <p class="text-xs text-slate-500">全栈开发者 / 币圈观察员</p>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 hover:text-brand-500 transition"><i class="fab fa-twitter"></i></button>
                                <button class="w-8 h-8 rounded-full bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-500 hover:text-brand-500 transition"><i class="fas fa-share-alt"></i></button>
                            </div>
                        </div>
                    </header>

                    <!-- Content Body (WordPress Entry Content) -->
                    <div class="p-8 entry-content text-slate-700 dark:text-slate-300">
                        <?php the_content(); ?>
                    </div>

                    <!-- Article Footer: Tags & Share -->
                    <div class="px-8 py-6 bg-slate-50 dark:bg-slate-900/50 border-t border-slate-100 dark:border-slate-700 flex flex-wrap items-center justify-between gap-4">
                        <div class="flex flex-wrap gap-2">
                            <i class="fas fa-tags text-slate-400 mt-1 mr-1"></i>
                            <?php the_tags('', '', ''); ?>
                        </div>
                        <div class="flex items-center text-sm text-slate-500">
                            <span class="mr-2">觉得不错？请作者喝杯咖啡</span>
                            <button class="text-brand-500 hover:text-brand-600 font-medium"><i class="fas fa-mug-hot"></i> 打赏</button>
                        </div>
                    </div>
                </div>

                <!-- Author Box Removed (Moved to Sidebar) -->

                <!-- Post Navigation -->
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <?php
                    $prev_post = get_previous_post();
                    if($prev_post):
                    ?>
                    <a href="<?php echo get_permalink($prev_post->ID); ?>" class="block p-6 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-brand-500 dark:hover:border-brand-500 group transition">
                        <span class="text-xs text-slate-400 uppercase tracking-wider mb-1 block">上一篇</span>
                        <h4 class="font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition truncate"><?php echo get_the_title($prev_post->ID); ?></h4>
                    </a>
                    <?php endif; ?>

                    <?php
                    $next_post = get_next_post();
                    if($next_post):
                    ?>
                    <a href="<?php echo get_permalink($next_post->ID); ?>" class="block p-6 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200 dark:border-slate-700 hover:border-brand-500 dark:hover:border-brand-500 group transition text-right">
                        <span class="text-xs text-slate-400 uppercase tracking-wider mb-1 block">下一篇</span>
                        <h4 class="font-bold text-slate-900 dark:text-white group-hover:text-brand-500 transition truncate"><?php echo get_the_title($next_post->ID); ?></h4>
                    </a>
                    <?php endif; ?>
                </div>

                <!-- Comments Section -->
                <?php
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

                <?php endwhile; ?>
            </div>

            <!-- Right Sidebar -->
            <?php get_sidebar(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
