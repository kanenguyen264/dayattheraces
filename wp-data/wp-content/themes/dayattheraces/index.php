<?php
/**
 * The main template file
 */

get_header();
?>

<main class="site-main" style="padding: 100px 20px 50px;">
    <div style="max-width: 1200px; margin: 0 auto;">
        <?php
        if (have_posts()) :
            while (have_posts()) : the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?> style="margin-bottom: 3rem;">
                    <h2 style="font-size: 2rem; margin-bottom: 1rem;">
                        <a href="<?php the_permalink(); ?>" style="color: #1a1a1a;">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    
                    <?php if (has_post_thumbnail()) : ?>
                        <div style="margin-bottom: 1rem;">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>
                    
                    <div style="color: #666; line-height: 1.8;">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <a href="<?php the_permalink(); ?>" style="color: #4a9eff; font-weight: 600;">
                        Read More →
                    </a>
                </article>
                <?php
            endwhile;
            
            the_posts_navigation();
        else :
            ?>
            <p>No posts found.</p>
        <?php endif; ?>
    </div>
</main>

<?php
get_footer();
?>
