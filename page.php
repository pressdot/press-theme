<?php get_header(); ?>

<!-- VIEW: PAGE -->
<div id="view-page" class="view-section active">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="lg:grid lg:grid-cols-12 lg:gap-8">
            
            <!-- Left Column: Page Content -->
            <div class="lg:col-span-8">
                <?php
                while (have_posts()) : the_post();
                ?>
                <!-- Breadcrumb -->
                <nav class="flex text-sm text-slate-500 dark:text-slate-400 mb-6" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2">
                        <li><a href="<?php echo home_url(); ?>" class="hover:text-brand-500">首页</a></li>
                        <li><i class="fas fa-chevron-right text-xs"></i></li>
                        <li class="text-slate-900 dark:text-slate-200 font-medium"><?php the_title(); ?></li>
                    </ol>
                </nav>

                <!-- Page Content -->
                <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-200 dark:border-slate-700 overflow-hidden">
                    <!-- Page Header -->
                    <header class="p-8 border-b border-slate-100 dark:border-slate-700/50">
                        <h1 class="text-3xl sm:text-4xl font-bold text-slate-900 dark:text-white mb-2 leading-tight">
                            <?php the_title(); ?>
                        </h1>
                    </header>

                    <!-- Content Body -->
                    <div class="p-8 entry-content text-slate-700 dark:text-slate-300">
                        <?php the_content(); ?>
                    </div>
                </div>

                <?php endwhile; ?>
            </div>

            <!-- Right Sidebar -->
            <?php get_sidebar(); ?>

        </div>
    </div>
</div>

<?php get_footer(); ?>
