<?php get_header(); ?>

<!-- Hero Section (unchanged, already has parallax via JS) -->
<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-video-wrap" id="heroImage">
        <div class="video-slide active">
            <iframe src="https://player.vimeo.com/video/1215171026?background=1&autoplay=1&muted=1&loop=0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    title="Hero background video 1"></iframe>
        </div>
        <div class="video-slide">
            <iframe src="https://player.vimeo.com/video/1215171025?background=1&muted=1&loop=0"
                    allow="autoplay; fullscreen; picture-in-picture"
                    title="Hero background video 2"></iframe>
        </div>
    </div>
    <div class="hero-content">
        <p class="hero-subtitle">Luxury Interior Design Studio</p>
        <h1 class="hero-title">Crafting Spaces That Tell Your Story</h1>
        <p class="hero-description">We transform environments into timeless sanctuaries of elegance, where every detail reflects the essence of refined living.</p>
        <div class="hero-cta">
            <a href="#portfolio" class="btn btn-filled">Explore Our Work</a>
            <a href="#contact" class="btn">Begin a Conversation</a>
        </div>
    </div>

</section>
<!-- Philosophy Section (homepage) -->
<section class="philosophy parallax-section philosophy-home" id="philosophy-home">
    <div class="parallax-bg" style="background-image: url('https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=1920&q=80');"></div>
    <div class="parallax-overlay" style="background: rgba(44,40,32,0.7);"></div>
    <div class="section-content">
        <div class="reveal">
            <p class="section-label">Our Philosophy</p>
            <h2 class="section-title">Design is not just what it looks like.<br>Design is how it makes you feel.</h2>
            <p class="philosophy-quote">"We create spaces that breathe, that welcome, that inspire moments of quiet contemplation and joyful gathering alike."</p>
        </div>
        <div class="philosophy-pillars reveal">
            <div class="pillar">
                <div class="pillar-icon">I</div>
                <h3>Intentionality</h3>
                <p>Every element serves a purpose. We eliminate the superfluous to amplify what truly matters.</p>
            </div>
            <div class="pillar">
                <div class="pillar-icon">II</div>
                <h3>Timelessness</h3>
                <p>We design beyond trends, creating spaces that remain relevant and beautiful for generations.</p>
            </div>
            <div class="pillar">
                <div class="pillar-icon">III</div>
                <h3>Harmony</h3>
                <p>The perfect balance of form, function, light, and texture creates environments of profound peace.</p>
            </div>
        </div>
    </div>
</section>


<!-- Portfolio Section — coverflow carousel on dark theme background -->
<section class="portfolio portfolio-coverflow-section parallax-section" id="portfolio">
    <div class="parallax-overlay" style="background: var(--color-charcoal);"></div>
    <div class="section-content">
        <div class="portfolio-header portfolio-header-centered reveal">
            <p class="section-label with-lines">Selected Work</p>
            <h2 class="section-title">Our Portfolio</h2>
        </div>

        <?php
        $args = array(
            'post_type'      => 'portfolio',
            'posts_per_page' => -1,
        );
        $portfolio_query = new WP_Query($args);
        $portfolio_items = [];
        if ($portfolio_query->have_posts()) :
            while ($portfolio_query->have_posts()) : $portfolio_query->the_post();
                $portfolio_items[] = [
                    'title'     => get_the_title(),
                    'permalink' => get_the_permalink(),
                    'thumb'     => has_post_thumbnail() ? get_the_post_thumbnail_url(null, 'large') : 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=80',
                ];
            endwhile;
            wp_reset_postdata();
        endif;

        $total_items = count($portfolio_items);
        ?>

        <?php if (!empty($portfolio_items)) : ?>
        <div class="portfolio-coverflow reveal">
            <?php if ($total_items > 1) : ?>
            <button class="portfolio-arrow-btn portfolio-arrow-prev" id="portfolioPrev" aria-label="Previous project">←</button>
            <?php endif; ?>

            <div class="portfolio-coverflow-track" id="portfolioTrack">
                <?php foreach ($portfolio_items as $i => $item) : ?>
                <div class="portfolio-slide-item" data-index="<?php echo $i; ?>">
                    <a href="<?php echo esc_url($item['permalink']); ?>" aria-label="<?php echo esc_attr($item['title']); ?>">
                        <img src="<?php echo esc_url($item['thumb']); ?>" alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
                    </a>
                </div>
                <?php endforeach; ?>
            </div>

            <?php if ($total_items > 1) : ?>
            <button class="portfolio-arrow-btn portfolio-arrow-next" id="portfolioNext" aria-label="Next project">→</button>
            <?php endif; ?>
        </div>

        <?php if ($total_items > 1) : ?>
        <div class="portfolio-slider-nav portfolio-dots-centered" id="portfolioDots">
            <?php for ($i = 0; $i < $total_items; $i++) : ?>
            <button class="portfolio-dot <?php echo $i === 0 ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></button>
            <?php endfor; ?>
        </div>
        <?php endif; ?>

        <div class="portfolio-view-all">
            <a href="<?php echo get_post_type_archive_link('portfolio'); ?>" class="btn">View All</a>
        </div>

        <?php else : ?>
            <p style="text-align:center;color:var(--color-cream);">No portfolio items found. Start adding some in the dashboard!</p>
        <?php endif; ?>
    </div>
</section>

<!-- Testimonials Section with Parallax -->
<section class="testimonials parallax-section" id="testimonials">
    <div class="parallax-bg" style="background-image: url('https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?w=1920&q=80');"></div>
    <div class="parallax-overlay" style="background: rgba(232,224,213,0.9);"></div>
    <div class="section-content">
        <div class="reveal">
            <h2 class="section-title">Client Stories</h2>
        </div>

        <div class="testimonial-container reveal">
            <div class="testimonial-wrapper">
                <div class="testimonial-track" id="testimonialTrack">
                    <?php 
                    $test_query = new WP_Query(['post_type' => 'testimonials', 'posts_per_page' => 10]);
                    $count = 0;
                    if ($test_query->have_posts()) : 
                        while ($test_query->have_posts()) : $test_query->the_post(); ?>
                            <div class="testimonial <?php echo ($count === 0) ? 'active' : ''; ?>">
                                <span class="testimonial-quote-mark">"</span>
                                <div class="testimonial-text"><?php the_content(); ?></div>
                                <p class="testimonial-author"><?php the_title(); ?></p>
                                <p class="testimonial-role">Verified Customer</p>
                            </div>
                        <?php 
                        $count++;
                        endwhile; wp_reset_postdata(); 
                    endif; ?>
                </div>
            </div>

            <div class="testimonial-nav" id="testimonialDots">
                <?php for($i = 0; $i < $count; $i++) : ?>
                    <button class="testimonial-dot <?php echo ($i === 0) ? 'active' : ''; ?>" data-index="<?php echo $i; ?>"></button>
                <?php endfor; ?>
            </div>

            <div class="testimonial-arrows">
                <button class="testimonial-arrow-btn" id="testimonialPrev" aria-label="Previous testimonial">←</button>
                <button class="testimonial-arrow-btn" id="testimonialNext" aria-label="Next testimonial">→</button>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section with Parallax -->
<section class="contact parallax-section" id="contact">
    <div class="parallax-bg" style="background-image: url('https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=1920&q=80');"></div>
    <div class="parallax-overlay" style="background: rgba(44,40,32,0.85);"></div>
    <div class="section-content">
        <div class="contact-grid">
            <div class="contact-info reveal">
                <p class="section-label">Get in Touch</p>
                <h2 class="section-title">Let's Create Something Beautiful Together</h2>
                <p>We'd love to hear about your vision. Whether you're embarking on a complete transformation or seeking to refresh a single room, our team is here to guide you every step of the way.</p>
                <div class="contact-details">
                    <div class="contact-item">
                        <label>Email</label>
                        <a href="mailto:artistiquespaces@gmail.com">artistiquespaces@gmail.com</a>
                    </div>
                    <div class="contact-item">
                        <label>Phone</label>
                        <a href="tel:7014249104">+91 7014249104</a>
						<br>
						<a href="tel:7014249104">+91 8376014824</a>
                    </div>
                    <div class="contact-item">
                        <label>Studio</label>
                        <span>A-block, Shivalik<br>Malviya nagar, New delhi<br>110017</span>
                    </div>
                </div>
            </div>
            <div class="contact-form-container reveal reveal-delay-2">
                <?php echo do_shortcode('[contact-form-7 id="6b054a6" title="Contact form 1"]'); ?>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer>
    <div class="footer-content">
        <div class="footer-logo">ARTISTIQUE SPACES</div>
        <div class="footer-links">
            <a href="https://www.instagram.com/artistiquespaces?utm_source=qr&igsh=NWJiOHZoc3U4ajQx">find us on Instagram</a>
            <a href="#">Privacy Policy</a>
        </div>
        <div class="footer-copyright">© 2026 Artistique Spaces. All rights reserved.</div>
    </div>
</footer>

<?php get_footer(); ?>