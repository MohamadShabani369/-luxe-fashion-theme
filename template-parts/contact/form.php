<?php
/**
 * Contact Form Section
 *
 * @package Luxe_Fashion
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

luxe_contact_message();
?>

<section class="contact-form-section">
    <div class="container">
        <div class="contact-form-grid">
            <div class="contact-form-wrap">
                <form
                    class="contact-form"
                    method="post"
                    action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
                >
                    <?php wp_nonce_field( 'luxe_contact', 'luxe_contact_nonce' ); ?>
                    <div class="contact-form-group">
                        <label for="luxe_contact_name" class="contact-form-label">
                            <?php esc_html_e( 'Name', 'luxe-fashion' ); ?>
                        </label>
                        <input
                            type="text"
                            id="luxe_contact_name"
                            name="luxe_contact_name"
                            class="contact-form-input"
                            required
                        >
                    </div>
                    <div class="contact-form-group">
                        <label for="luxe_contact_email" class="contact-form-label">
                            <?php esc_html_e( 'Email', 'luxe-fashion' ); ?>
                        </label>
                        <input
                            type="email"
                            id="luxe_contact_email"
                            name="luxe_contact_email"
                            class="contact-form-input"
                            required
                        >
                    </div>
                    <div class="contact-form-group">
                        <label for="luxe_contact_subject" class="contact-form-label">
                            <?php esc_html_e( 'Subject', 'luxe-fashion' ); ?>
                        </label>
                        <input
                            type="text"
                            id="luxe_contact_subject"
                            name="luxe_contact_subject"
                            class="contact-form-input"
                        >
                    </div>
                    <div class="contact-form-group">
                        <label for="luxe_contact_message" class="contact-form-label">
                            <?php esc_html_e( 'Message', 'luxe-fashion' ); ?>
                        </label>
                        <textarea
                            id="luxe_contact_message"
                            name="luxe_contact_message"
                            class="contact-form-textarea"
                            required
                        ></textarea>
                    </div>
                    <button type="submit" class="contact-form-submit">
                        <?php esc_html_e( 'Send Message', 'luxe-fashion' ); ?>
                    </button>
                </form>
            </div>
            <div class="contact-map-wrap">
                <div class="contact-map">
                    <button class="contact-map-button" onclick="window.open('https://www.openstreetmap.org/?mlat=35.6892&mlon=51.3890','_blank')">
                        <?php esc_html_e( 'View on Map', 'luxe-fashion' ); ?>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>