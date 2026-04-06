<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area mt-16 pt-16 border-t border-gray-100 max-w-3xl mx-auto">

	<?php if ( have_comments() ) : ?>
		<h2 class="text-2xl font-serif font-medium text-gray-900 mb-8">
			<?php
			$comments_number = get_comments_number();
			if ( '1' === $comments_number ) {
				printf( tr( 'one_thought_on' ), '<span>' . get_the_title() . '</span>' );
			} else {
				printf(
					tr( 'thoughts_on' ),
					number_format_i18n( $comments_number ),
					'<span>' . get_the_title() . '</span>'
				);
			}
			?>
		</h2>

		<ol class="space-y-8 mb-12">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 48,
					'callback'   => function($comment, $args, $depth) {
						?>
						<li id="comment-<?php comment_ID(); ?>" <?php comment_class('flex gap-4'); ?>>
							<div class="flex-shrink-0">
								<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'], '', '', array('class' => 'rounded-full') ); ?>
							</div>
							<div class="flex-grow">
								<div class="bg-ivory p-6 rounded-2xl border border-gray-50">
									<div class="flex items-center justify-between mb-2">
										<h4 class="text-sm font-bold text-gray-900"><?php echo get_comment_author_link(); ?></h4>
										<time datetime="<?php comment_time( 'c' ); ?>" class="text-xs text-gray-500 font-medium">
											<?php echo yaghnob_get_localized_comment_date( $comment->comment_ID ); ?>
										</time>
									</div>
									
									<?php if ( '0' == $comment->comment_approved ) : ?>
										<p class="text-xs text-amber-600 mb-2"><?php echo tr( 'comment_awaiting_moderation' ); ?></p>
									<?php endif; ?>

									<div class="prose prose-sm text-gray-600 mb-4">
										<?php comment_text(); ?>
									</div>

									<div class="text-xs font-bold uppercase tracking-wide">
										<?php
										comment_reply_link(
											array_merge(
												$args,
												array(
													'depth'     => $depth,
													'max_depth' => $args['max_depth'],
													'before'    => '',
													'after'     => '',
													'reply_text' => tr( 'reply' ),
													'class'     => 'text-primary hover:text-gray-900 transition-colors',
												)
											)
										);
										?>
									</div>
								</div>
							</div>
						</li>
						<?php
					}
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => '<span class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-primary transition-colors">&larr; ' . tr('older_comments') . '</span>',
				'next_text' => '<span class="text-xs font-bold uppercase tracking-widest text-gray-500 hover:text-primary transition-colors">' . tr('newer_comments') . ' &rarr;</span>',
				'class'     => 'flex justify-between border-t border-gray-100 pt-8',
			)
		);
		?>

	<?php endif; // Check for have_comments(). ?>

	<?php
	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
		<p class="text-center text-gray-500 italic mt-8"><?php echo tr('comments_closed'); ?></p>
		<?php
	endif;

	$comment_form_args = array(
		'title_reply'          => '<span class="font-serif text-2xl text-gray-900">' . tr('leave_comment') . '</span>',
		'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title mb-6">',
		'title_reply_after'    => '</h3>',
		'label_submit'         => tr('post_comment'),
		'class_submit'         => 'cursor-pointer inline-flex justify-center rounded-full bg-primary px-8 py-3 text-sm font-semibold text-white shadow-sm hover:bg-gray-900 transition-all duration-300',
		'submit_field'         => '<div class="form-submit mt-8">%1$s %2$s</div>',
		'comment_notes_before' => '<p class="comment-notes text-sm text-gray-500 mb-6">' . tr('email_note') . '</p>',
		'comment_field'        => '<div class="mb-6"><label for="comment" class="sr-only">' . tr('comment_noun') . '</label><textarea id="comment" name="comment" cols="45" rows="8" class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 resize-none transition-shadow duration-300" placeholder="' . tr('write_thoughts') . '" required></textarea></div>',
		'fields'               => array(
			'author' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6"><div class="comment-form-author"><label for="author" class="sr-only">' . tr('name') . '</label><input id="author" name="author" type="text" value="" size="30" class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 transition-shadow duration-300" placeholder="' . tr('name') . ( $req ? '*' : '' ) . '" ' . ( $req ? 'required' : '' ) . ' /></div>',
			'email'  => '<div class="comment-form-email"><label for="email" class="sr-only">' . tr('email') . '</label><input id="email" name="email" type="email" value="" size="30" class="block w-full rounded-lg border-0 px-4 py-3 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-primary sm:text-sm sm:leading-6 transition-shadow duration-300" placeholder="' . tr('email') . ( $req ? '*' : '' ) . '" ' . ( $req ? 'required' : '' ) . ' /></div></div>',
			'url'    => '', // Remove website field to keep it simple
			'cookies' => '<p class="comment-form-cookies-consent mb-6 flex items-start gap-2"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes" class="mt-1 h-4 w-4 rounded border-gray-300 text-primary focus:ring-primary" /> <label for="wp-comment-cookies-consent" class="text-sm text-gray-600">' . tr('save_info') . '</label></p>',
		),
	);

	comment_form( $comment_form_args );
	?>

</div>