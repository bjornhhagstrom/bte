<?php
/*
 Template Name: Series Preview
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="m-all t-all d-all cf" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>

									<p class="byline vcard">
										<?php printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
									</p>

								</header>

								<section class="entry-content cf" itemprop="articleBody">
									<?php the_content(); ?>

                  <div class="preview-panels cf">

                    <div class="flexslider">

                      <?php if( have_rows('add_a_panel') ): ?>

                        <ol class="flex-control-nav flex-control-paging">

                          <?php while( have_rows('add_a_panel') ): the_row();

                            // vars
                            $panel_tab = get_sub_field('panel_tab');

                            ?>

                            <li><a href="#"><?php echo $panel_tab; ?></a></li>

                          <?php endwhile; ?>

                        </ol>

                      <?php endif; ?>

                      <?php if( have_rows('add_a_panel') ): ?>

                        <ul class="slides">

                        <?php while( have_rows('add_a_panel') ): the_row();

                          // vars
                          $panel_title = get_sub_field('panel_title');
                          $panel_content = get_sub_field('panel_content');
                          $panel_cta_text = get_sub_field('panel_cta_text');
                          $panel_cta_link = get_sub_field('panel_cta_link');

                          ?>

                          <li class="slide">

                            <div class="panel-wrapper">

                              <span class="panel-title h1"><?php echo $panel_title; ?></span>

                              <span class="panel-content"><?php echo $panel_content; ?></span>

                              <a class="panel-cta" href="<?php echo $panel_cta_link; ?>"><?php echo $panel_cta_text; ?></a>
                              
                            </div>

                          </li>

                        <?php endwhile; ?>

                        </ul>

                      <?php endif; ?>

                    </div>

                  </div>
								</section>

								<footer class="article-footer">

                  <?php // the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

								</footer>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

				</div>

			</div>


<?php get_footer(); ?>
