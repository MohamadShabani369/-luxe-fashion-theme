<?php
/**
 * About Team Section
 *
 * @package Luxe_Fashion
 */

declare( strict_types=1 );

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

$team_members = [
    [
        'name'  => get_theme_mod( 'luxe_team_1_name', 'Sara Ahmadi' ),
        'role'  => get_theme_mod( 'luxe_team_1_role', 'Founder & Creative Director' ),
        'image' => get_theme_mod(
            'luxe_team_1_image',
            get_template_directory_uri() . '/assets/img/team-1.jpg'
        ),
    ],
    [
        'name'  => get_theme_mod( 'luxe_team_2_name', 'Neda Karimi' ),
        'role'  => get_theme_mod( 'luxe_team_2_role', 'Head of Design' ),
        'image' => get_theme_mod(
            'luxe_team_2_image',
            get_template_directory_uri() . '/assets/img/team-2.jpg'
        ),
    ],
    [
        'name'  => get_theme_mod( 'luxe_team_3_name', 'Mina Rezaei' ),
        'role'  => get_theme_mod( 'luxe_team_3_role', 'Production Manager' ),
        'image' => get_theme_mod(
            'luxe_team_3_image',
            get_template_directory_uri() . '/assets/img/team-3.jpg'
        ),
    ],
    [
        'name'  => get_theme_mod( 'luxe_team_4_name', 'Lila Moradi' ),
        'role'  => get_theme_mod( 'luxe_team_4_role', 'Brand Manager' ),
        'image' => get_theme_mod(
            'luxe_team_4_image',
            get_template_directory_uri() . '/assets/img/team-4.jpg'
        ),
    ],
];
?>
<section class="about-team">
    <div class="container">

        <header class="about-team-header">
            <p class="about-eyebrow">
                <?php esc_html_e( 'OUR TEAM', 'luxe-fashion' ); ?>
            </p>
            <h2 class="about-story-title">
                <?php esc_html_e( 'The Women Behind the Brand', 'luxe-fashion' ); ?>
            </h2>
        </header>

        <div class="about-team-grid">
            <?php foreach ( $team_members as $member ) : ?>
                <article class="about-team-member">
                    <div class="about-team-photo">
                        <img
                            src="<?php echo esc_url( $member['image'] ); ?>"
                            alt="<?php echo esc_attr( $member['name'] ); ?>"
                            loading="lazy"
                        >
                    </div>
                    <h3 class="about-team-name">
                        <?php echo esc_html( $member['name'] ); ?>
                    </h3>
                    <p class="about-team-role">
                        <?php echo esc_html( $member['role'] ); ?>
                    </p>
                </article>
            <?php endforeach; ?>
        </div>

    </div>
</section>