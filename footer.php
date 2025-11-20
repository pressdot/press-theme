        </div><!-- .barba-container -->
    </main><!-- #barba-wrapper -->

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 py-12 mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div class="col-span-1 md:col-span-2">
                    <a href="<?php echo home_url(); ?>" class="text-2xl font-bold tracking-tighter text-slate-900 dark:text-white flex items-center gap-2 mb-4">
                        <span class="bg-brand-600 text-white w-8 h-8 rounded-lg flex items-center justify-center text-lg">P</span>
                        <span>Press<span class="text-brand-500">.</span>gy</span>
                    </a>
                    <p class="text-slate-500 dark:text-slate-400 text-sm max-w-xs leading-relaxed">
                        <?php bloginfo('description'); ?>
                    </p>
                    <p class="text-slate-400 text-xs mt-4">© <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-4">链接</h4>
                    <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                        <li><a href="#" class="hover:text-brand-500">关于博主</a></li>
                        <li><a href="#" class="hover:text-brand-500">友情链接</a></li>
                        <li><a href="#" class="hover:text-brand-500">留言板</a></li>
                        <li><a href="<?php bloginfo('rss2_url'); ?>" class="hover:text-brand-500">RSS 订阅</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold text-slate-900 dark:text-white mb-4">联系</h4>
                    <ul class="space-y-2 text-sm text-slate-500 dark:text-slate-400">
                        <li><i class="fab fa-github w-5"></i> GitHub</li>
                        <li><i class="fab fa-twitter w-5"></i> Twitter</li>
                        <li><i class="fas fa-envelope w-5"></i> Email</li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>
