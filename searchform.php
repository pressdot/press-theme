<form role="search" method="get" class="search-form relative" action="<?php echo home_url('/'); ?>">
    <label>
        <span class="screen-reader-text">Search for:</span>
        <input type="search" class="search-field block w-full pl-4 pr-12 py-3 bg-slate-100 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl focus:ring-2 focus:ring-brand-500 focus:border-transparent outline-none transition text-slate-900 dark:text-white placeholder-slate-400" placeholder="搜索文章..." value="<?php echo get_search_query(); ?>" name="s" />
    </label>
    <button type="submit" class="search-submit absolute right-2 top-1/2 transform -translate-y-1/2 p-2 text-slate-400 hover:text-brand-500 transition">
        <i class="fas fa-search text-lg"></i>
    </button>
</form>
