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

                <?php $section_args = array(
                  'sort_order' => 'ASC',
                  'sort_column' => 'menu_order',
                  'child_of' => $post->ID,
                  'parent' => $post->ID
                ); 
                $sections = get_pages($section_args); 
                
                // make the preview sections
                if( $sections ): ?>

                <ul class="preview-sections nav cf">
                
                  <?php $section_count = 0; 
                  
                  foreach( $sections as $section ): 

                  $section_count++;

                  // vars
                  $section_title = $section->post_title;
                  $section_slug = $section->post_name;
                  $section_id = $section->ID;

                  ?>

                  <li class="<?php echo 'section-' . $section_count; ?> <?php echo $section_slug; ?>">

                    <?php echo $section_title; ?>

                      <?php 
                      $subpage_args = array(
                        'sort_order' => 'ASC',
                        'sort_column' => 'menu_order',
                        'child_of' => $section_id
                      ); 
                      $subpages = get_pages($subpage_args); 
                      
                      // make sub-pages
                      if( $subpages ): 
                      $i = 0; 
                      $count = count($subpages); ?>

                        <ul class="sub-pages sub-menu cf">

                          <?php foreach( $subpages as $subpage ):

                          // vars
                          $panel_id = $subpage->ID;
                          $panel_title = $subpage->post_title;
                          $panel_content = $subpage->post_content;
                          ?>

                          <li class="sub-page">
                            <?php echo $panel_title; ?>
                          </li>

                        <?php endforeach; // end foreach ?>

                        </ul>

                      <?php endif; // end sub-pages ?>

                    </li>

                  <?php endforeach; // end foreach section ?>

                </ul>
  
                <?php endif; // end if sections ?>

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>

								</header>

								<section class="entry-content cf" itemprop="articleBody">
									
                  <?php the_content(); ?>

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
