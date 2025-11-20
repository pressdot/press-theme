<?php
if (post_password_required()) {
    return;
}
?>

<div class="mt-12" id="comments">
    <?php if (have_comments()) : ?>
        <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-8 flex items-center">
            <i class="far fa-comments text-brand-500 mr-3"></i> 评论 (<?php echo get_comments_number(); ?>)
        </h3>

        <div class="space-y-8">
            <?php
            wp_list_comments(array(
                'style'       => 'div',
                'short_ping'  => true,
                'avatar_size' => 40,
                'callback'    => 'press_theme_comment',
            ));
            ?>
        </div>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
            <nav class="navigation comment-navigation mt-8" role="navigation">
                <div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments', 'press-theme')); ?></div>
                <div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;', 'press-theme')); ?></div>
            </nav>
        <?php endif; ?>

    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
        <p class="no-comments text-slate-500 mt-8"><?php _e('Comments are closed.', 'press-theme'); ?></p>
    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email');
    $aria_req = ($req ? " aria-required='true'" : '');

    $fields = array(
        'author' => '<div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">' .
            '<input id="author" name="author" type="text" placeholder="昵称' . ($req ? ' *' : '') . '" value="' . esc_attr($commenter['comment_author']) . '" ' . $aria_req . ' class="w-full px-4 py-2 rounded-lg bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 dark:focus:border-brand-500 transition text-sm" />',
        'email'  => '<input id="email" name="email" type="email" placeholder="邮箱' . ($req ? ' *' : '') . '" value="' . esc_attr($commenter['comment_author_email']) . '" ' . $aria_req . ' class="w-full px-4 py-2 rounded-lg bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 dark:focus:border-brand-500 transition text-sm" /></div>',
        'url'    => '', // Hiding URL field for cleaner look as per design, or can add if needed
    );

    $comments_args = array(
        'title_reply_before' => '<h4 class="text-sm font-bold text-slate-900 dark:text-white mb-4">',
        'title_reply'        => '发表评论',
        'title_reply_after'  => '</h4>',
        'class_container'    => 'bg-white dark:bg-slate-800 rounded-2xl p-6 mb-10 border border-slate-200 dark:border-slate-700 shadow-sm mt-10',
        'comment_field'      => '<textarea id="comment" name="comment" rows="4" placeholder="说点什么吧..." aria-required="true" class="w-full px-4 py-2 rounded-lg bg-slate-50 dark:bg-slate-900 border border-slate-200 dark:border-slate-700 focus:outline-none focus:border-brand-500 dark:focus:border-brand-500 transition text-sm mb-4"></textarea>',
        'fields'             => $fields,
        'label_submit'       => '提交评论',
        'class_submit'       => 'bg-brand-600 hover:bg-brand-700 text-white px-6 py-2 rounded-lg font-medium text-sm transition shadow-lg shadow-brand-500/30 cursor-pointer border-none',
        'submit_button'      => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
    );

    comment_form($comments_args);
    ?>
</div>
