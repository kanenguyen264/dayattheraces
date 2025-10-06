<footer class="site-footer">
    <div class="footer-container">
        <div class="footer-column">
            <h3>About Us</h3>
            <p>Experience the thrill of horse racing with small deposits and flexible payments.</p>
            <div class="social-links">
                <a href="#" aria-label="Facebook">f</a>
                <a href="#" aria-label="Twitter">𝕏</a>
                <a href="#" aria-label="Instagram">📷</a>
                <a href="#" aria-label="YouTube">▶</a>
            </div>
        </div>

        <div class="footer-column">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/events')); ?>">Events</a></li>
                <li><a href="<?php echo esc_url(home_url('/about')); ?>">About</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Support</h3>
            <ul>
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>

        <div class="footer-column">
            <h3>Contact</h3>
            <ul>
                <li>Email: info@dayattheraces.com</li>
                <li>Phone: +1 234 567 890</li>
                <li>Address: 123 Racing Street</li>
            </ul>
        </div>
    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
