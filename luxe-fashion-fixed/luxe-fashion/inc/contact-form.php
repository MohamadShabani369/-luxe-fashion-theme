<?php
/**
 * Contact Form Handler
 *
 * @package Luxe_Fashion
 */

declare( strict_types = 1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Process the contact form submission.
 *
 * Hooks: admin_post_nopriv_luxe_contact, admin_post_luxe_contact
 *
 * @return void
 */
function luxe_process_contact_form() : void {

    if ( ! isset( $_POST['luxe_contact_nonce'] ) || ! wp_verify_nonce(
        sanitize_text_field( $_POST['luxe_contact_nonce'] ),
        'luxe_contact'
    ) ) {
        wp_redirect( add_query_arg( 'contact', 'invalid', home_url( '/contact/' ) ) );
        exit;
    }

    $name    = isset( $_POST['luxe_contact_name'] )
        ? sanitize_text_field( wp_unslash( $_POST['luxe_contact_name'] ) )
        : '';
    $email   = isset( $_POST['luxe_contact_email'] )
        ? sanitize_email( wp_unslash( $_POST['luxe_contact_email'] ) )
        : '';
    $subject = isset( $_POST['luxe_contact_subject'] )
        ? sanitize_text_field( wp_unslash( $_POST['luxe_contact_subject'] ) )
        : '';
    $message = isset( $_POST['luxe_contact_message'] )
        ? sanitize_textarea_field( wp_unslash( $_POST['luxe_contact_message'] ) )
        : '';

    /* Validate required fields. */
    if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
        wp_redirect( add_query_arg( 'contact', 'error', home_url( '/contact/' ) ) );
        exit;
    }

    if ( ! is_email( $email ) ) {
        wp_redirect( add_query_arg( 'contact', 'invalid', home_url( '/contact/' ) ) );
        exit;
    }

    /* Send email. */
    $to      = get_option( 'admin_email' );
    $subject = sprintf(
        '[%s] %s',
        get_bloginfo( 'name' ),
        $subject
    );
    $headers = sprintf(
        "From: %s <%s>\r\nContent-Type: text/plain; charset=UTF-8",
        $name,
        $email
    );
    $body    = sprintf(
        "Name: %s\nEmail: %s\nSubject: %s\n\nMessage:\n%s",
        $name,
        $email,
        $subject,
        $message
    );

    $sent = wp_mail( $to, $subject, $body, $headers );

    if ( $sent ) {
        wp_redirect( add_query_arg( 'contact', 'success', home_url( '/contact/' ) ) );
    } else {
        wp_redirect( add_query_arg( 'contact', 'error', home_url( '/contact/' ) ) );
    }
    exit;
}

add_action( 'admin_post_nopriv_luxe_contact', 'luxe_process_contact_form' );
add_action( 'admin_post_luxe_contact', 'luxe_process_contact_form' );

/**
 * Display contact form message based on query parameter.
 *
 * @return void
 */
function luxe_contact_message() : void {
    if ( ! isset( $_GET['contact'] ) ) {
        return;
    }

    $type = sanitize_text_field( $_GET['contact'] );

    $messages = [
        'success' => esc_html__( 'Your message has been sent. We will be in touch soon.', 'luxe-fashion' ),
        'error'   => esc_html__( 'Something went wrong. Please try again.', 'luxe-fashion' ),
        'invalid' => esc_html__( 'Invalid submission. Please fill all required fields.', 'luxe-fashion' ),
    ];

    if ( ! isset( $messages[ $type ] ) ) {
        return;
    }

    printf(
        '<div class="contact-message"><p>%s</p></div>',
        esc_html( $messages[ $type ] )
    );
}