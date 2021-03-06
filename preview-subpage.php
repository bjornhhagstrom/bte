<?php
/*
 Template Name: Preview Sub-Page
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

  						<?php
              global $post;
              $post_id = $post->ID;
              $ancestors = get_post_ancestors( $post->ID );            
              
              foreach ($ancestors as $ancestor) {
                $template = get_page_template_slug( $ancestor );
                if($template == 'preview.php') {
                  $ancestor_id = $ancestor;
                  $ancestor_page = get_page( $ancestor );
                  $ancestor_title = $ancestor_page->post_title;
                  $preview = 'true';
                }
              } ?>

              <?php if($preview == 'true'): ?>
              
              <div class="preview-header-nav cf">
                
                <?php $section_args = array(
                  'sort_order' => 'ASC',
                  'sort_column' => 'menu_order',
                  'child_of' => $ancestor_id,
                  'parent' => $ancestor_id
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

                  <li class="<?php echo 'section-' . $section_count; ?> <?php echo $section_slug; ?> preview-section">

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

                          <li class="sub-page<?php if( $panel_id == $post_id ){ echo ' current'; } ?>">
                            <a href="<?php echo get_page_link($panel_id); ?>"><?php echo $panel_title; ?></a>
                          </li>

                        <?php endforeach; // end foreach ?>

                        </ul>

                      <?php endif; // end sub-pages ?>

                    </li>

                  <?php endforeach; // end foreach section ?>

                </ul>
  
                <?php endif; // end if sections ?>
              </div>

              <?php endif; // end if preview page ?>

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">
									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>
								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php the_content(); ?>
								</section> <?php // end article section ?>

								<footer class="article-footer cf">

                  <?php
                  if($preview == 'true'):  
                    $parent_args = array(
                      'sort_order' => 'ASC',
                      'sort_column' => 'menu_order',
                      'child_of' => $ancestor_id,
                      'parent' => $ancestor_id
                    ); 
                    $parents = get_pages($parent_args);

                    foreach( $parents as $parent ):
                      // vars
                      $parent_id = $parent->ID;

                      $subpage_args = array(
                        'sort_order' => 'ASC',
                        'sort_column' => 'menu_order',
                        'child_of' => $parent_id
                      ); 
                      $subpages = get_pages($subpage_args);

                      foreach( $subpages as $subpage ):

                        $siblings[] += $subpage->ID;
                        $current = array_search(get_the_ID(), $siblings);
                        $prevID = $siblings[$current-1];
                        $nextID = $siblings[$current+1];

                      endforeach; // end for each sub page

                    endforeach; // end for each parent page
                  endif; // end if preview page 
                  ?>

                  <div class="preview-footer-nav cf">
                    <nav>
                    <?php if(get_field('call_to_action_text')) { ?>
                      <div class="cta center">
                        <a class="button" href="<?php the_field('call_to_action_link'); ?>" title="<?php the_field('call_to_action_text') ?>">
                          <?php the_field('call_to_action_text') ?>
                        </a>
                      </div>
                    <?php } ?>
                    <?php if (!empty($prevID)) { ?>
                      <div class="prev">
                        <a href="<?php echo get_permalink($prevID); ?>" title="<?php echo get_the_title($prevID); ?>">
                          <strong>&laquo;&nbsp;Previous</strong><br />
                          <?php echo get_the_title($prevID); ?>
                        </a>
                      </div>
                      <?php }
                      if (!empty($nextID)) { ?>
                      <div class="next">
                      <a href="<?php echo get_permalink($nextID); ?>" title="<?php echo get_the_title($nextID); ?>">
                        <strong>Next&nbsp;&raquo;</strong><br />
                        <?php echo get_the_title($nextID); ?>
                      </a>
                      </div>
                    <?php } ?>
                    </nav>
                  </div><!-- .navigation -->

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
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						<?php // get_sidebar(); ?>

				</div>

			</div>

<?php get_footer(); ?>
