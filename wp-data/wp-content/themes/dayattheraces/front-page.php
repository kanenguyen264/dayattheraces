<?php
/**
 * Template Name: Front Page
 * The main homepage template
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
    <img src="<?php echo get_template_directory_uri(); ?>/images/hero-bg.jpg" alt="Horse Racing" class="hero-background">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title">WITH SMALL DEPOSITS<br>AND FLEXIBLE PAYMENTS</h1>
        <p class="hero-subtitle">Experience the thrill of horse racing with easy access and convenient payment options</p>
        <a href="#events" class="hero-cta">Explore Events</a>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="about">
    <div class="about-container">
        <div class="about-content">
            <h2>About Us</h2>
            <p>Welcome to Day at the Races, where passion meets excitement. We bring you the most thrilling horse racing events with unparalleled access and flexibility.</p>
            <p>Our platform offers small deposit options and flexible payment plans, making it easier than ever to enjoy the sport of kings. Whether you're a seasoned racing enthusiast or new to the track, we provide an unforgettable experience.</p>
            <p>Join thousands of satisfied customers who trust us for their racing entertainment. With state-of-the-art facilities, expert commentary, and premium viewing experiences, every day at the races is a day to remember.</p>
        </div>
        <div class="about-image">
            <img src="<?php echo get_template_directory_uri(); ?>/images/jockey.jpg" alt="Professional Jockey">
        </div>
    </div>
</section>

<!-- Key Events Section -->
<section class="events-section" id="events">
    <h2 class="section-title">Key Events</h2>
    <div class="events-grid">
        <?php
        $events = new WP_Query(array(
            'post_type' => 'event',
            'posts_per_page' => 6,
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($events->have_posts()) :
            while ($events->have_posts()) : $events->the_post();
                $event_date = get_post_meta(get_the_ID(), '_event_date', true);
                ?>
                <div class="event-card">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('large', array('class' => 'event-image')); ?>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/default-event.jpg" alt="<?php the_title(); ?>" class="event-image">
                    <?php endif; ?>
                    <div class="event-overlay">
                        <h3 class="event-title"><?php the_title(); ?></h3>
                        <?php if ($event_date) : ?>
                            <p class="event-date"><?php echo date('F j, Y', strtotime($event_date)); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Default events if none exist
            ?>
            <div class="event-card">
                <img src="<?php echo get_template_directory_uri(); ?>/images/event1.jpg" alt="Melbourne Cup" class="event-image">
                <div class="event-overlay">
                    <h3 class="event-title">Melbourne Cup</h3>
                    <p class="event-date">November 7, 2025</p>
                </div>
            </div>
            <div class="event-card">
                <img src="<?php echo get_template_directory_uri(); ?>/images/event2.jpg" alt="Gold Coast" class="event-image">
                <div class="event-overlay">
                    <h3 class="event-title">Gold Coast Magic Millions</h3>
                    <p class="event-date">January 15, 2026</p>
                </div>
            </div>
            <div class="event-card">
                <img src="<?php echo get_template_directory_uri(); ?>/images/event3.jpg" alt="Royal Ascot" class="event-image">
                <div class="event-overlay">
                    <h3 class="event-title">Royal Ascot</h3>
                    <p class="event-date">June 20, 2026</p>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Partners Section -->
<section class="partners-section" id="partners">
    <h2 class="section-title">Our Partners</h2>
    <div class="partners-grid">
        <?php
        $partners = new WP_Query(array(
            'post_type' => 'partner',
            'posts_per_page' => 8,
            'orderby' => 'menu_order',
            'order' => 'ASC'
        ));

        if ($partners->have_posts()) :
            while ($partners->have_posts()) : $partners->the_post();
                ?>
                <div class="partner-logo">
                    <?php if (has_post_thumbnail()) : ?>
                        <?php the_post_thumbnail('medium'); ?>
                    <?php else : ?>
                        <span><?php the_title(); ?></span>
                    <?php endif; ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Default partners
            ?>
            <div class="partner-logo"><span>RACING POST</span></div>
            <div class="partner-logo"><span>THE STRAITS TIMES</span></div>
            <div class="partner-logo"><span>Rewards</span></div>
            <div class="partner-logo"><span>FITZMARKS</span></div>
            <div class="partner-logo"><span>The Telegraph</span></div>
            <div class="partner-logo"><span>IAS</span></div>
            <div class="partner-logo"><span>Racing TV</span></div>
            <div class="partner-logo"><span>SKY RACING</span></div>
        <?php endif; ?>
    </div>
</section>

<!-- Reviews Section -->
<section class="reviews-section" id="reviews">
    <h2 class="section-title">Reviews</h2>
    <div class="reviews-container">
        <?php
        $reviews = new WP_Query(array(
            'post_type' => 'review',
            'posts_per_page' => 3,
            'orderby' => 'date',
            'order' => 'DESC'
        ));

        if ($reviews->have_posts()) :
            while ($reviews->have_posts()) : $reviews->the_post();
                $rating = get_post_meta(get_the_ID(), '_review_rating', true);
                if (!$rating) $rating = 5;
                ?>
                <div class="review-card">
                    <div class="review-stars">
                        <?php for ($i = 0; $i < $rating; $i++) : ?>
                            ⭐
                        <?php endfor; ?>
                    </div>
                    <div class="review-text">
                        <?php the_content(); ?>
                    </div>
                    <div class="review-author">
                        — <?php the_title(); ?>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        else :
            // Default review
            ?>
            <div class="review-card">
                <div class="review-stars">⭐⭐⭐⭐⭐</div>
                <div class="review-text">
                    "An absolutely fantastic experience! The flexible payment options made it so easy to attend multiple events throughout the season. The atmosphere is electric, and the staff are incredibly professional. Highly recommend to anyone interested in horse racing!"
                </div>
                <div class="review-author">— Sarah Johnson</div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
?>
