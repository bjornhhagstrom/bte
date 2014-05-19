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

								</header>

								<section class="entry-content cf" itemprop="articleBody">
									<?php the_content(); ?>
								</section>

                <?php $section_args = array(
                  'sort_order' => 'ASC',
                  'sort_column' => 'menu_order',
                  'child_of' => $post->ID,
                  'parent' => $post->ID
                ); 
                $sections = get_pages($section_args); 
                
                // make the preview sections
                if( $sections ): 
                
                $section_count = 0; 
                  
                  foreach( $sections as $section ): 

                  $section_count++;

                  // vars
                  $section_title = $section->post_title;
                  $section_slug = $section->post_name;
                  $section_id = $section->ID;

                  // layout the first section
                  if($section_count == 1): ?>

                  <section class="<?php echo 'section-' . $section_count; ?> <?php echo $section_slug; ?> cf">

                    <h5 class="section-title">1. <?php echo $section_title; ?></h5>
                    <div class="cf"></div>

                    <div class="flexslider">

                      <?php 
                      $subpage_args = array(
                        'sort_order' => 'ASC',
                        'sort_column' => 'menu_order',
                        'child_of' => $section_id
                      ); 
                      $subpages = get_pages($subpage_args); 
                      
                      // make slideshow nav
                      if( $subpages ): 
                      $i = 0; 
                      $count = count($subpages); 
                      ?>

                        <ol class="flex-control-nav flex-control-paging">

                          <?php foreach( $subpages as $subpage ): $i++;

                            // vars
                            $panel_tab = $subpage->post_title;
                            $panel_tab_class = $subpage->post_name;
                            ?>

                            <li class="<?php echo $panel_tab_class; ?> t-1of<?php echo $count;?> d-1of<?php echo $count;?>">
                              <a href="#"><?php echo $panel_tab; ?></a>
                            </li>

                          <?php endforeach; //end foreach sub page ?>

                        </ol>

                      <?php endif; // end slideshow nav ?>

                      <?php 
                      // make slides
                      if( $subpages ): ?>

                        <ul class="slides">

                        <?php foreach( $subpages as $subpage ):

                          // vars
                          $panel_id = $subpage->ID;
                          $panel_title = $subpage->post_title;
                          $panel_content = $subpage->post_content;
                          ?>

                          <li class="slide">

                            <div class="panel-wrapper">

                              <span class="panel-title h1"><?php echo $panel_title; ?></span>

                              <span class="panel-content"><?php echo $panel_content; ?></span>

                              <div class="panel-cta">
                                <a class="button" href="<?php the_field('call_to_action_link', $panel_id); ?>"><?php the_field('call_to_action_text', $panel_id); ?></a>
                              </div>

                            </div>

                          </li>

                        <?php endforeach; // end foreach ?>

                        </ul>

                      <?php endif; // end slides ?>

                    </div>
                    
                  </section>
                    
                  <?php endif; // end FIRST section ?> 

                  <?php if($section_count == '2'): ?>

                  <section class="<?php echo 'section-' . $section_count; ?> <?php echo $page_slug; ?> entry-content cf">
                    <h5 class="section-title">2. <?php echo $section_title; ?></h5>
                    <?php 
                    $subpage_args = array(
                      'sort_order' => 'ASC',
                      'sort_column' => 'menu_order',
                      'child_of' => $section_id
                    ); 
                    $subpages = get_pages($subpage_args); 
                    
                    // make list
                    if( $subpages ): 
                    $i = 0; 
                    $count = count($subpages);
                    ?>
                    <ul>

                      <?php foreach( $subpages as $subpage ): $i++;

                      // vars
                      $subpage_title = $subpage->post_title;
                      $subpage_content = $subpage->post_content;
                      $subpage_excerpt = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.';
                      $subpage_id = $subpage->ID;
                      ?>

                      <li class="m-all t-1of<?php echo $count; ?> d-1of<?php echo $count; ?><?php if($i % $count == '0'){ echo ' last-col'; } ?>">
                        <h3><span style="font-size: 4em;">&#10006;</span><br /><?php echo $subpage_title; ?></h3>
                        <p><?php echo $subpage_excerpt; ?></p>
                        <p><a class="button" href="<?php echo get_page_link($subpage_id); ?>" title="<?php echo $subpage_title; ?>">Learn More</a></p>
                      </li>
                      <?php endforeach; // end list ?>

                    </ul>
                    <?php endif; // end subpages ?>
                  </section>

                  <?php endif; // end SECOND section ?>

                  <?php if($section_count == '3'): ?>

                  <section class="<?php echo 'section-' . $section_count; ?> <?php echo $page_slug; ?> entry-content cf">
                    <h5 class="section-title">3. <?php echo $section_title; ?></h5>
                    <?php 
                    $subpage_args = array(
                      'sort_order' => 'ASC',
                      'sort_column' => 'menu_order',
                      'child_of' => $section_id
                    ); 
                    $subpages = get_pages($subpage_args); 
                    
                    // make list
                    if( $subpages ): 
                    $i = 0; 
                    $count = count($subpages);
                    ?>
                    <ul>

                      <?php foreach( $subpages as $subpage ): $i++;

                      // vars
                      $subpage_title = $subpage->post_title;
                      $subpage_content = $subpage->post_content;
                      $subpage_excerpt = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.';
                      $subpage_id = $subpage->ID;
                      ?>

                      <li class="m-all t-1of<?php echo $count; ?> d-1of<?php echo $count; ?><?php if($i % $count == '0'){ echo ' last-col'; } ?>">
                        <h3><span style="font-size: 2em;">&#9872;</span> <?php echo $subpage_title; ?></h3>
                        <p><?php echo $subpage_excerpt; ?></p>
                        <p><a class="button" href="<?php echo get_page_link($subpage_id); ?>" title="<?php echo $subpage_title; ?>">Learn More</a></p>
                      </li>
                      <?php endforeach; // end list ?>

                    </ul>
                    <?php endif; // end subpages ?>
                  </section>

                  <?php endif; // end THIRD section ?>

                  <?php if($section_count == '4'): ?>

                  <section class="<?php echo 'section-' . $section_count; ?> <?php echo $page_slug; ?> entry-content cf">
                    <h5 class="section-title">4. <?php echo $section_title; ?></h5>
                    <?php 
                    $subpage_args = array(
                      'sort_order' => 'ASC',
                      'sort_column' => 'menu_order',
                      'child_of' => $section_id
                    ); 
                    $subpages = get_pages($subpage_args); 
                    
                    // make list
                    if( $subpages ): 
                    $i = 0; 
                    $count = count($subpages);
                    ?>
                    <ul>

                      <?php foreach( $subpages as $subpage ): $i++;

                      // vars
                      $subpage_title = $subpage->post_title;
                      $subpage_content = $subpage->post_content;
                      $subpage_excerpt = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh.';
                      $subpage_id = $subpage->ID;
                      ?>

                      <li class="m-all t-1of<?php echo $count; ?> d-1of<?php echo $count; ?><?php if($i % $count == '0'){ echo ' last-col'; } ?>">
                        <h3><?php echo $subpage_title; ?></h3>
                        <p><?php echo $subpage_excerpt; ?></p>
                        <p><a class="button" href="<?php echo get_page_link($subpage_id); ?>" title="<?php echo $subpage_title; ?>">Learn More</a></p>
                      </li>
                      <?php endforeach; // end list ?>

                    </ul>
                    <?php endif; // end subpages ?>
                  </section>

                  <?php endif; // end FOURTH section ?> 

                <?php endforeach; endif; // end foreach section, end if sections ?>

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
