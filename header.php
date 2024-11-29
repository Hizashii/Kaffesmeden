<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <link rel="stylesheet" href="styles.css">
    <title><?php echo esc_html(get_bloginfo('name')); ?></title>
</head>
<body <?php body_class(); ?>>

<header>
    <!-- Logo -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="header-logo">
        <?php 
        // Display the hero logo (moved from hero section)
        $hero_logo = get_field('hero_logo');
        if ($hero_logo): ?>
            <img src="<?php echo esc_url($hero_logo['url']); ?>" alt="<?php echo esc_attr(pll__('Hero Logo', 'Header')); ?>" class="logo-image">
        <?php else: ?>
            <?php echo esc_html(pll__('Coffee Store', 'Header')); ?>
        <?php endif; ?>
    </a>

    <!-- Burger Menu Button -->
    <button class="burger-menu" aria-label="<?php echo esc_attr(pll__('Open Menu', 'Header')); ?>">
        <div class="burger-line"></div>
        <div class="burger-line"></div>
        <div class="burger-line"></div>
    </button>

    <!-- Custom Slide-in Menu -->
    <nav class="custom-nav-menu">
        <ul>
            <li><a href="#home"><?php echo esc_html(pll__('Home', 'Menu')); ?></a></li>
            <li><a href="#menu"><?php echo esc_html(pll__('Menu', 'Menu')); ?></a></li>
            <li><a href="#about"><?php echo esc_html(pll__('About Us', 'Menu')); ?></a></li>
            <li><a href="#environment"><?php echo esc_html(pll__('Sustainability', 'Menu')); ?></a></li>
            <li><a href="#contact"><?php echo esc_html(pll__('Contact', 'Menu')); ?></a></li>
        </ul>
        <div class="language-switcher">
    <?php 
    // WPML language switcher function
    if ( function_exists('pll_the_languages') ) {
        pll_the_languages(array(
            'dropdown' => 1, // Display as a dropdown menu (optional)
            'show_flags' => 1, // Show flags (optional)
            'show_names' => 1, // Show language names (optional)
        ));
    }
    ?>
</div>
    </nav>
    
</header>



<script>
document.addEventListener('DOMContentLoaded', function () {
    const burgerButton = document.querySelector('.burger-menu');
    const navMenu = document.querySelector('.custom-nav-menu');

    // Toggle the menu visibility when the burger icon is clicked
    burgerButton.addEventListener('click', function () {
        burgerButton.classList.toggle('open');   // Toggle burger button animation
        navMenu.classList.toggle('open');       // Toggle the menu visibility
    });

    // Optional: Close the menu if clicking outside the menu or burger button
    document.addEventListener('click', function (event) {
        if (!navMenu.contains(event.target) && !burgerButton.contains(event.target) && navMenu.classList.contains('open')) {
            navMenu.classList.remove('open');   // Close the menu
            burgerButton.classList.remove('open');  // Reset burger icon
        }
    });
});

</script>


</body>
</html>
