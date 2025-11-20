<div class="lg:col-span-4 mt-12 lg:mt-0 space-y-8">
    <!-- Profile Widget -->
    <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-20 bg-gradient-to-r from-brand-600 to-purple-600"></div>
        <div class="relative flex flex-col items-center mt-4">
            <div class="w-20 h-20 rounded-full border-4 border-white dark:border-slate-800 bg-slate-200 overflow-hidden shadow-lg">
                <img src="https://ui-avatars.com/api/?name=Admin&background=0ea5e9&color=fff&size=128" alt="Author">
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white mt-3"><?php the_author_meta('display_name', 1); ?></h3>
            <p class="text-sm text-slate-500 dark:text-slate-400 mb-4">全栈开发者 / 币圈老韭菜</p>
            <p class="text-center text-slate-600 dark:text-slate-300 text-sm leading-relaxed mb-6">
                已在风雨中度过 <span class="font-mono text-brand-500">4111</span> 天。
                热衷于折腾 C#、Linux 和寻找下一个百倍币。
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

    <!-- Tags Cloud -->
    <div class="mt-8 bg-white dark:bg-slate-800 rounded-2xl p-6 border border-slate-200 dark:border-slate-700 shadow-sm">
        <h3 class="font-bold text-slate-900 dark:text-white mb-4 border-l-4 border-brand-500 pl-3">热门标签</h3>
        <div class="flex flex-wrap gap-2">
            <?php
            $tags = get_tags(array('number' => 10, 'orderby' => 'count', 'order' => 'DESC'));
            foreach($tags as $tag) {
                echo '<a href="' . get_tag_link($tag->term_id) . '" class="text-xs px-3 py-1.5 rounded-full bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 hover:bg-brand-500 hover:text-white transition">#' . $tag->name . '</a>';
            }
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
