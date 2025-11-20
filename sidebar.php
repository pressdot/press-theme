<div class="lg:col-span-4 mt-12 lg:mt-0 space-y-8">
    <!-- Profile Widget -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-r from-brand-600 to-purple-600"></div>
        <div class="relative flex flex-col items-center mt-4">
            <div class="w-20 h-20 rounded-full border-4 border-white dark:border-slate-800 bg-slate-200 overflow-hidden shadow-lg">
                <?php echo get_avatar(get_the_author_meta('ID'), 128, '', '', array('class' => 'w-full h-full object-cover')); ?>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mt-3"><?php the_author(); ?></h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">全栈开发者 / 币圈老韭菜</p>
            <p class="text-center text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-6">
                <?php echo get_the_author_meta('description') ? get_the_author_meta('description') : 'Exploring the world of code and crypto.'; ?>
            </p>
            <div class="flex space-x-4">
                <a href="#" class="w-8 h-8 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-brand-500 hover:text-white transition"><i class="fab fa-github"></i></a>
                <a href="#" class="w-8 h-8 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-blue-400 hover:text-white transition"><i class="fab fa-twitter"></i></a>
                <a href="#" class="w-8 h-8 rounded bg-slate-100 dark:bg-slate-700 flex items-center justify-center text-slate-600 dark:text-slate-400 hover:bg-red-500 hover:text-white transition"><i class="fas fa-envelope"></i></a>
            </div>
        </div>
    </div>

    <!-- Categories Widget -->
    <div class="mt-8 bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm">
        <h3 class="font-bold text-slate-900 dark:text-white mb-4 border-l-4 border-brand-500 pl-3">专题分类</h3>
        <div class="space-y-2">
            <?php
            $categories = get_categories();
            foreach($categories as $category) {
                echo '<a href="' . get_category_link($category->term_id) . '" class="flex items-center justify-between p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700/50 group transition">';
                echo '<span class="text-slate-600 dark:text-slate-300 group-hover:text-brand-500"><i class="fas fa-folder w-6 text-center mr-2 text-slate-400 group-hover:text-brand-500"></i> ' . $category->name . '</span>';
                echo '<span class="bg-slate-100 dark:bg-slate-700 text-xs text-slate-500 px-2 py-1 rounded-full">' . $category->count . '</span>';
                echo '</a>';
            }
            ?>
        </div>
    </div>

    <!-- Popular Posts Widget -->
    <div class="mt-8 bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm">
        <h3 class="font-bold text-slate-900 dark:text-white mb-4 border-l-4 border-brand-500 pl-3">热门文章</h3>
        <div class="space-y-4">
            <?php
            $popular = new WP_Query(array(
                'posts_per_page' => 5,
                'meta_key' => 'views',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'ignore_sticky_posts' => 1
            ));
            if ($popular->have_posts()) :
                while ($popular->have_posts()) : $popular->the_post();
            ?>
            <a href="<?php the_permalink(); ?>" class="flex gap-3 group">
                <span class="text-2xl font-bold text-slate-200 dark:text-slate-700 group-hover:text-brand-500 transition">0<?php echo $popular->current_post + 1; ?></span>
                <div>
                    <h4 class="text-sm font-medium text-slate-900 dark:text-white group-hover:text-brand-500 transition line-clamp-2"><?php the_title(); ?></h4>
                    <span class="text-xs text-slate-400 mt-1 block"><i class="far fa-eye mr-1"></i> <?php echo (int) get_post_meta(get_the_ID(), 'views', true); ?></span>
                </div>
            </a>
            <?php
                endwhile;
                wp_reset_postdata();
            else:
                echo '<p class="text-sm text-slate-500">暂无热门文章</p>';
            endif;
            ?>
        </div>
    </div>

    <!-- Newsletter -->
    <div class="mt-8 bg-gradient-to-br from-brand-900 to-slate-900 rounded-2xl p-6 text-white shadow-lg relative overflow-hidden">
        <i class="fas fa-paper-plane absolute -bottom-4 -right-4 text-8xl text-white/5"></i>
        <h3 class="font-bold text-lg mb-2">订阅更新</h3>
        <p class="text-slate-300 text-sm mb-4">不错过任何一次牛市信号和技术干货。</p>
        <form class="space-y-2">
            <input type="email" placeholder="your@email.com" class="w-full px-4 py-2 rounded bg-white/10 border border-white/20 text-white placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-500 text-sm">
            <button class="w-full bg-brand-600 hover:bg-brand-500 text-white py-2 rounded text-sm font-bold transition">订阅</button>
        </form>
    </div>
</div>
