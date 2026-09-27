<?php
/**
 * Social + Hours Section
 *
 * @package Luxe_Fashion
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>
<section class="contact-social-hours">
    <div class="container">
        <div class="contact-social-hours-grid">
            <div class="contact-social">
                <p class="contact-social-title">
                    <?php esc_html_e( 'Follow Us', 'luxe-fashion' ); ?>
                </p>
                <div class="social-icons">
                    <a href="https://instagram.com/luxefashion"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Instagram">
                        <svg width="20" height="20"
                             viewBox="0 0 24 24" fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <rect x="2" y="2" width="20"
                                  height="20" rx="5" ry="5"></rect>
                            <path d="M16 11.37
                                A4 4 0 1 1 12.63 8
                                4 4 0 0 1 16 11.37z"></path>
                            <line x1="17.5" y1="6.5"
                                  x2="17.51" y2="6.5"></line>
                        </svg>
                    </a>

                    <a href="https://pinterest.com/luxefashion"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Pinterest">
                        <svg width="20" height="20"
                             viewBox="0 0 24 24" fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <circle cx="12" cy="12"
                                    r="10"></circle>
                            <line x1="8" y1="20"
                                  x2="12" y2="12"></line>
                            <path d="M12 12
                                a3 3 0 1 1 3-3"></path>
                        </svg>
                    </a>

                    <a href="https://facebook.com/luxefashion"
                       target="_blank"
                       rel="noopener noreferrer"
                       aria-label="Facebook">
                        <svg width="20" height="20"
                             viewBox="0 0 24 24" fill="none"
                             stroke="currentColor"
                             stroke-width="1.8"
                             stroke-linecap="round"
                             stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0
                                -5 5v3H7v4h3v8h4v-8h3l1-4
                                h-4V7a1 1 0 0 1 1-1h3z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="contact-hours">
                <p class="contact-hours-title">
                    <?php esc_html_e( 'Store Hours', 'luxe-fashion' ); ?>
                </p>
                <ul class="store-hours">
                    <li>
                        <span class="day">
                            <?php esc_html_e( 'Mon — Fri', 'luxe-fashion' ); ?>
                        </span>
                        <span class="time">
                            <?php esc_html_e( '10:00 AM - 8:00 PM', 'luxe-fashion' ); ?>
                        </span>
                    </li>
                    <li>
                        <span class="day">
                            <?php esc_html_e( 'Sat', 'luxe-fashion' ); ?>
                        </span>
                        <span class="time">
                            <?php esc_html_e( '11:00 AM - 6:00 PM', 'luxe-fashion' ); ?>
                        </span>
                    </li>
                    <li>
                        <span class="day">
                            <?php esc_html_e( 'Sun', 'luxe-fashion' ); ?>
                        </span>
                        <span class="time">
                            <?php esc_html_e( 'Closed', 'luxe-fashion' ); ?>
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>