<?php
$id       = get_theme_mod( 'onepress_features_id', 'features' );
$disable  = get_theme_mod( 'onepress_features_disable' ) == 1 ? true : false;
$title    = get_theme_mod( 'onepress_features_title', esc_html__('Features', 'onepress' ));
$subtitle = get_theme_mod( 'onepress_features_subtitle', esc_html__('Why choose Us', 'onepress' ));
if ( onepress_is_selective_refresh() ) {
    $disable = false;
}
$data  = onepress_get_features_data();
if ( !$disable && !empty( $data ) ) {
    $desc = get_theme_mod( 'onepress_features_desc' );
?>
<?php if ( ! onepress_is_selective_refresh() ){ ?>
<section id="<?php if ( $id != '') { echo esc_attr( $id ); } ?>" <?php do_action('onepress_section_atts', 'features'); ?>
         class="<?php echo esc_attr(apply_filters('onepress_section_class', 'section-features section-padding section-meta onepage-section', 'features')); ?>">
<?php } ?>
    <?php do_action('onepress_section_before_inner', 'features'); ?>
    <div class="<?php echo esc_attr( apply_filters( 'onepress_section_container_class', 'container', 'features' ) ); ?>">
        <?php if ( $title ||  $subtitle || $desc ){ ?>
        <div class="section-title-area">
            <?php if ($subtitle != '') echo '<h5 class="section-subtitle">' . esc_html($subtitle) . '</h5>'; ?>
            <?php if ($title != '') echo '<h2 class="section-title">' . esc_html($title) . '</h2>'; ?>
            <?php if ( $desc ) {
                echo '<div class="section-desc">' . apply_filters( 'onepress_the_content', wp_kses_post( $desc ) ) . '</div>';
            } ?>
        </div>
        <?php } ?>
        <div class="section-content">
            <div class="row">
            <?php
            $len = sizeof($data);
            $forLastClass = $len % 2 !== 1;
            for ($i = 0; $i < sizeof($data); $i++) {
                $f = $data[$i];
                $f =  wp_parse_args( $f, array(
                    'image' => '',
                    'link' => '',
                    'title' => '',
                    'desc' => '',
                ) );
                $img_url = onepress_get_media_url( $f['image'] );
                $image_alt = get_post_meta( $f['image']['id'], '_wp_attachment_image_alt', true);
                ?>
                <div class="feature-item col-12 p-0 mb-min-8 <?php if ($i < $len - 1 || $forLastClass) echo 'col-md-6';?>">
                    <?php if ( $f['link'] ) { ?><a title="<?php echo esc_attr( $f['title'] ) ?>" href="<?php echo esc_url( $f['link']  ); ?>"><?php } ?>
                        <div class="img-container">
                        <img src="<?php echo esc_url( $img_url ); ?>" alt=" echo <?php echo $image_alt; ?>"/>
                        <div class="overlay">
                            <div>
                                <h2><?php echo esc_html( $f['title'] ); ?></h2>
                                <?php echo apply_filters( 'the_content', $f['desc'] ); ?>
                            </div>
                        </div>
                    </div>
                    <?php if ( $f['link'] ) { ?></a><?php } ?>
                </div>
            <?php
            } // end forloop
            ?>
            </div>
        </div>
    </div>
    <?php do_action('onepress_section_after_inner', 'features'); ?>

<?php if ( ! onepress_is_selective_refresh() ){ ?>
</section>
<?php } ?>
<?php } ?>
