<?php
/**
 * Template Name: Home Page
 */

get_header(); 
?>

<?php
// Get the BackgroundHome image field
$background_image = _pll(get_field('backgroundhome'));
?>
<!-- Hero Section (Home) -->
<div class="hero-section" id="home" style="background-image: url('<?php echo esc_url($background_image['url']); ?>');">
    <div class="hero-content">
        <?php 
        // Display the hero title
        $hero_title = _pll(get_field('hero_title'));
        if ($hero_title): ?>
            <h1 class="hero-title">
                <?php echo esc_html($hero_title); ?>
            </h1>
        <?php endif; ?>

        <!-- Circular Subtitle Text -->
        <div class="text-ring">
            <?php
            $hero_subtitle_text = pll__('Enjoy a cup of coffee with us, and discover our unique coffee culture!');
            $characters = mb_str_split($hero_subtitle_text);
            echo '<p class="hero-subtitle" style="--total: ' . count($characters) . ';">';
            foreach ($characters as $index => $character) {
                echo '<span style="--index: ' . $index . ';">' . esc_html($character) . '</span>';
            }
            echo '</p>';
            ?>
        </div>

        <!-- Translatable Button -->
        <a href="http://kaffesmeden.local/wp-content/uploads/2024/11/Menukort_kaffesmeden.pdf" class="hero-subtitle-button" download><?php echo pll__('Download Our Menu'); ?></a>

        <?php 
        // Display the coffee splash image
        $coffee_splash_image = _pll(get_field('coffee_splash'));
        if ($coffee_splash_image): ?>
            <img src="<?php echo esc_url($coffee_splash_image['url']); ?>" alt="<?php echo esc_attr(pll__('Coffee Splash')); ?>" class="coffee-splash-image">
        <?php endif; ?>
    </div>
</div>

<!-- Awards Section -->
<div class="awards-section">
    <h2 class="awards-title"><?php echo pll__('Our Awards'); ?></h2>
    <div class="awards-carousel">
        <?php
        for ($i = 1; $i <= 9; $i++):
            $award_image = _pll(get_field('image_' . $i));
            if ($award_image):
                echo '<div class="award-item"><img src="' . esc_url($award_image['url']) . '" alt="' . esc_attr(sprintf(pll__('Award Image %d'), $i)) . '" class="award-image"></div>';
            endif;
        endfor;
        ?>
        
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const carousel = document.querySelector('.awards-carousel');

        // Automatically scroll the carousel to the right
        function autoScroll() {
            carousel.scrollBy({
                left: 1,
                behavior: 'smooth'
            });
        }
        let autoScrollInterval = setInterval(autoScroll, 1);

        // Pause scrolling when user interacts with carousel
        carousel.addEventListener('mouseover', () => clearInterval(autoScrollInterval));
        carousel.addEventListener('mouseleave', () => {
            autoScrollInterval = setInterval(autoScroll, 1);
        });

        // Scroll based on mouse wheel direction
        carousel.addEventListener('wheel', (event) => {
            event.preventDefault();
            if (event.deltaY > 0) {
                // Scroll right when scrolling down
                carousel.scrollBy({
                    left: 300,
                    behavior: 'smooth'
                });
            } else {
                // Scroll left when scrolling up
                carousel.scrollBy({
                    left: -300,
                    behavior: 'smooth'
                });
            }
        });
    });
    </script>
</div>

<!-- Coffee Gallery Section -->
<div class="coffee-gallery-section" id="menu">
    <div class="coffee-gallery-container">
        <h2 class="coffee-gallery-title"><?php echo esc_html(_pll(get_field('coffee_menu_title'))); ?></h2>
        <div class="coffee-gallery-images">
            <?php 
            for ($i = 1; $i <= 15; $i++) {
                $coffee_image = _pll(get_field('coffee_image_' . $i));
                if ($coffee_image): ?>
                    <div class="coffee-gallery-image-item">
                        <img src="<?php echo esc_url($coffee_image['url']); ?>" alt="<?php echo esc_attr($coffee_image['alt']) ?: sprintf(pll__('Coffee Image %d'), $i); ?>" class="coffee-gallery-image" loading="lazy">
                    </div>
                <?php endif;
            } ?>
        </div>
    </div>
</div>

<!-- Coffee Story Section -->
<div class="coffee-story-section" id="about">
    <div class="coffee-story-container">
        <h2 class="coffee-story-title"><?php echo esc_html(_pll(get_field('coffe_story'))); ?></h2>
        <div class="coffee-story-content">
            <?php 
            $bags_image = _pll(get_field('bags_image'));
            if ($bags_image): ?>
                <img src="<?php echo esc_url($bags_image['url']); ?>" alt="<?php echo esc_attr($bags_image['alt']); ?>" class="coffee-bags-image">
            <?php endif; ?>
            <div>
                <p class="coffee-story-text"><?php echo esc_html(_pll(get_field('coffe_text'))); ?></p>
                <div class="button-wrapper">
                    <a href="/about" class="learn-more-btn"><?php echo pll__('Learn More'); ?></a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sustainability Section -->
<div class="sustainability-section" id="environment">
    <div class="sustainability-container">
        <h2 class="sustainability-title"><?php echo esc_html(_pll(get_field('sustainability_title'))); ?></h2>
        <p class="sustainability-text"><?php echo esc_html(_pll(get_field('sustainability_text'))); ?></p>
        <div class="sustainability-images">
            <?php 
            for ($i = 1; $i <= 8; $i++) {
                $sustainability_image = _pll(get_field('sustainability_image_' . $i));
                if ($sustainability_image): ?>
                    <div class="sustainability-image-item">
                        <img src="<?php echo esc_url($sustainability_image['url']); ?>" alt="<?php echo esc_attr($sustainability_image['alt']) ?: sprintf(pll__('Sustainability Image %d'), $i); ?>" class="sustainability-image" loading="lazy">
                    </div>
                <?php endif;
            } ?>
        </div>
    </div>
</div>

<!-- Contact Section -->
<div class="contact-section" id="contact">
    <div class="contact-container">
        <div class="contact-form">
            <?php 
            // Check the current language using WPML
            if ( function_exists('pll_current_language') ) {
                $current_language = pll_current_language(); // Get the current language code (e.g., 'en', 'da')

                // Display Danish form if the language is Danish ('da')
                if ($current_language == 'da') {
                    echo do_shortcode('[contact-form-7 id="6f9fc6a" title="Contact_copy"]');
                }
                // Display English form for other languages ('en')
                else {
                    echo do_shortcode('[contact-form-7 id="dfd12a1" title="Contact"]');
                }
            }
            ?>
        </div>
    </div>
</div>

<!-- Visit Us Section -->
<div class="visit-us-section">
    <div class="visit-us-container">
        <div class="visit-us-left">
            <div class="visit-us-content">
                <h2 class="visit-us-title"><?php echo esc_html(_pll(get_field('visit_us'))); ?></h2>
                <p class="open-hours"><?php echo esc_html(_pll(get_field('open_hours'))); ?></p>
            </div>
        </div>
        <div class="visit-us-map">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2254.7553268385526!2d8.76273961612602!3d55.32856958045524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x464b52dfba2911eb%3A0x8153d69a9a9e44e9!2sKaffesmeden%2C%20Overdammen%203%2C%206760%20Ribe%2C%20Denmark!5e0!3m2!1sen!2us!4v1690198078430!5m2!1sen!2us" 
                width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

<!-- Follow Us Section -->
<div class="follow-us-section">
    <div class="follow-us-container">
        <h2 class="follow-us-title"><?php echo esc_html(_pll(get_field('follow_us'))); ?></h2>
        <div class="instagram-section">
            <div class="social-icons">
                <?php
                $facebook_icon = _pll(get_field('facebook'));
                $instagram_icon = _pll(get_field('instagram'));

                if ($facebook_icon): ?>
                    <a href="https://www.facebook.com/KaffesmedenEsbjerg/" target="_blank" rel="noopener noreferrer" class="social-icon">
                        <img src="<?php echo esc_url($facebook_icon['url']); ?>" alt="Facebook" class="social-icon-image">
                    </a>
                <?php endif; ?>
                <?php if ($instagram_icon): ?>
                    <a href="https://www.instagram.com/kaffesmedenribe/" target="_blank" rel="noopener noreferrer" class="social-icon">
                        <img src="<?php echo esc_url($instagram_icon['url']); ?>" alt="Instagram" class="social-icon-image">
                    </a>
                <?php endif; ?>
            </div>
            <div class="instagram-content">
                <a href="https://www.instagram.com/kaffesmedenribe/" target="_blank">
                    <?php
                    $coffee_cup_image = _pll(get_field('coffee_cup_image'));
                    if ($coffee_cup_image): ?>
                        <img src="<?php echo esc_url($coffee_cup_image['url']); ?>" alt="<?php echo esc_attr($coffee_cup_image['alt']); ?>" class="coffee-cup-image">
                    <?php endif; ?>
                </a>
            </div>
            <p class="instagram-note"><?php echo pll__('Follow us on Instagram to stay updated on our latest news, events, and offers!'); ?></p>
        </div>
    </div>   
</div>

<?php wp_footer(); ?>



<script>
    document.addEventListener('DOMContentLoaded', function () {
        const burgerButton = document.querySelector('.burger-menu');
        const navMenu = document.querySelector('.custom-nav-menu');

        // Handle burger button for opening and closing the menu
        burgerButton.addEventListener('click', function () {
            burgerButton.classList.toggle('open');
            navMenu.classList.toggle('open');
        });

        // Optional: Close the menu if clicking anywhere outside the menu
        document.addEventListener('click', function (event) {
            if (!navMenu.contains(event.target) && !burgerButton.contains(event.target) && navMenu.classList.contains('open')) {
                navMenu.classList.remove('open');
                burgerButton.classList.remove('open');
            }
        });

        // Handle navigation link clicks for smooth scrolling to the center
        const navLinks = document.querySelectorAll('.custom-nav-menu a[href^="#"]');
        navLinks.forEach(function (link) {
            link.addEventListener('click', function (event) {
                event.preventDefault(); // Prevent the default anchor link behavior

                const targetId = link.getAttribute('href').substring(1);
                const targetSection = document.getElementById(targetId);

                if (targetSection) {
                    // Get the position of the target element relative to the viewport
                    const targetPosition = targetSection.getBoundingClientRect().top;

                    // Get the viewport height
                    const viewportHeight = window.innerHeight;

                    // Calculate the position to scroll to for centering the section
                    const scrollPosition = window.scrollY + targetPosition - (viewportHeight / 2) + (targetSection.offsetHeight / 2);

                    // Scroll to the calculated position
                    window.scrollTo({
                        top: scrollPosition,
                        behavior: 'smooth'
                    });

                    // Close the burger menu after clicking on a link if open
                    if (burgerButton.classList.contains('open')) {
                        burgerButton.classList.remove('open');
                        navMenu.classList.remove('open');
                    }
                }
            });
        });
    });
</script>

</body>
</html>
