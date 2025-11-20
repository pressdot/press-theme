<?php get_header(); ?>

<!-- VIEW: 404 -->
<div id="view-404" class="view-section active">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 text-center">
        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 p-12 inline-block">
            <h1 class="text-6xl font-bold text-brand-500 mb-4">404</h1>
            <h2 class="text-2xl font-bold text-slate-900 dark:text-white mb-6">页面未找到</h2>
            <p class="text-slate-600 dark:text-slate-400 mb-8">抱歉，您访问的页面不存在或已被移除。</p>
            <a href="<?php echo home_url(); ?>" class="bg-brand-600 hover:bg-brand-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                返回首页
            </a>
        </div>
    </div>
</div>

<?php get_footer(); ?>
