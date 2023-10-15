<?php
/**
 * Theme functions and definitions
 *
 * @package educate_training_coach
 */

if ( ! function_exists( 'educate_training_coach_enqueue_styles' ) ) :
	/**
	 * Load assets.
	 *
	 * @since 1.0.0
	 */
	function educate_training_coach_enqueue_styles() {
		wp_enqueue_style( 'education-insight-style-parent', get_template_directory_uri() . '/style.css' );
		wp_enqueue_style( 'educate-training-coach-style', get_stylesheet_directory_uri() . '/style.css', array( 'education-insight-style-parent' ), '1.0.0' );

    // Theme Customize CSS.
    require get_parent_theme_file_path( 'inc/extra_customization.php' );
    wp_add_inline_style( 'educate-training-coach-style',$education_insight_custom_style );

    require get_theme_file_path( 'inc/extra_customization.php' );
    wp_add_inline_style( 'educate-training-coach-style',$education_insight_custom_style );
	}
endif;
add_action( 'wp_enqueue_scripts', 'educate_training_coach_enqueue_styles', 99 );

function educate_training_coach_customize_register() {
    global $wp_customize;
  $wp_customize->remove_section( 'education_insight_pro' );
  $wp_customize->remove_setting( 'education_insight_popular_courses_heading' );
  $wp_customize->remove_control( 'education_insight_popular_courses_heading' );
  $wp_customize->remove_setting( 'education_insight_slider_content_alignment' );
  $wp_customize->remove_control( 'education_insight_slider_content_alignment' );
}
add_action( 'customize_register', 'educate_training_coach_customize_register', 11 );

function educate_training_coach_customize( $wp_customize ) {

  wp_enqueue_style('customizercustom_css', get_stylesheet_directory_uri(). '/assets/css/customizer.css');

  require get_theme_file_path( 'inc/custom-control.php' );

  $wp_customize->add_section('educate_training_coach_pro', array(
    'title'    => __('UPGRADE EDUCATE PREMIUM', 'educate-training-coach'),
    'priority' => 1,
  ));

  $wp_customize->add_setting('educate_training_coach_pro', array(
    'default'           => null,
    'sanitize_callback' => 'sanitize_text_field',
  ));
  $wp_customize->add_control(new Educate_Training_Coach_Pro_Control($wp_customize, 'educate_training_coach_pro', array(
    'label'    => __('EDUCATE TRAINING PREMIUM', 'educate-training-coach'),
    'section'  => 'educate_training_coach_pro',
    'settings' => 'educate_training_coach_pro',
    'priority' => 1,
  )));

  $wp_customize->add_setting('educate_training_coach_slider_content_alignment',array(
        'default' => 'LEFT-ALIGN',
        'sanitize_callback' => 'education_insight_sanitize_choices'
  ));
  $wp_customize->add_control('educate_training_coach_slider_content_alignment',array(
        'type' => 'select',
        'label' => __('Slider Content Alignment','educate-training-coach'),
        'section' => 'education_insight_slider_section',
        'choices' => array(
            'LEFT-ALIGN' => __('LEFT-ALIGN','educate-training-coach'),
            'CENTER-ALIGN' => __('CENTER-ALIGN','educate-training-coach'),
            'RIGHT-ALIGN' => __('RIGHT-ALIGN','educate-training-coach'),),
        'active_callback' => 'education_insight_slider_dropdown',
  ) );
    $wp_customize->add_setting(
    'education_insight_admission_enable',
    array(
      'type'                 => 'option',
      'capability'           => 'edit_theme_options',
      'theme_supports'       => '',
      'default'              => '1',
      'transport'            => 'refresh',
      'sanitize_callback'    => 'education_insight_callback_sanitize_switch',
    )
  );
  $wp_customize->add_control(
    new Educate_Training_Coach_Customizer_Customcontrol_Switch(
      $wp_customize,
      'education_insight_admission_enable',
      array(
        'settings'        => 'education_insight_admission_enable',
        'section'         => 'education_insight_top',
        'label'           => __( 'Check to show Button', 'educate-training-coach' ),      
        'choices'     => array(
          '1'      => __( 'On', 'educate-training-coach' ),
          'off'    => __( 'Off', 'educate-training-coach' ),
        ),
        'active_callback' => '',
      )
    )
  );
  $wp_customize->add_setting('education_insight_admission_text',array(
    'default' => '',
    'sanitize_callback'  => 'sanitize_text_field'
  ));
  $wp_customize->add_control('education_insight_admission_text',array(
    'type' => 'text',
    'label' => __('Button Text','educate-training-coach'),
    'section' => 'education_insight_top',
  ));

	$wp_customize->selective_refresh->add_partial( 'education_insight_admission_text', array(
		'selector' => '.admision-btn a',
		'render_callback' => 'education_insight_customize_partial_education_insight_admission_text',
	) );

  $wp_customize->add_setting('education_insight_admission_link',array(
    'default' => '',
    'sanitize_callback'  => 'esc_url_raw'
  ));
  $wp_customize->add_control('education_insight_admission_link',array(
    'type' => 'url',
    'label' => __('Button Link','educate-training-coach'),
    'section' => 'education_insight_top',
  ));  

  $wp_customize->add_setting('educate_training_coach_courses_heading',array(
      'default' => '',
      'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('educate_training_coach_courses_heading',array(
      'label' => esc_html__('Add Heading','educate-training-coach'),
      'section' => 'education_insight_popular_courses',
      'type'    => 'text',
      'active_callback' => 'education_insight_popular_courses_dropdown',
    ));

  $wp_customize->add_setting('educate_training_coach_courses_text',array(
    'default' => '',
    'sanitize_callback' => 'sanitize_text_field'
  ));
  $wp_customize->add_control('educate_training_coach_courses_text',array(
    'label' => esc_html__('Add Text','educate-training-coach'),
    'section' => 'education_insight_popular_courses',
    'type'    => 'textarea',
    'active_callback' => 'education_insight_popular_courses_dropdown',
  ));

}
add_action( 'customize_register', 'educate_training_coach_customize' );

function educate_training_coach_setup() {

  add_theme_support( "align-wide" );
  add_theme_support( "wp-block-styles" );
  add_theme_support( 'responsive-embeds' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'title-tag' );
  add_theme_support('custom-background',array(
    'default-color' => 'ffffff',
  ));

  $GLOBALS['content_width'] = 525;

  add_theme_support( 'html5', array(
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ) );

  // Add theme support for Custom Logo.
  add_theme_support( 'custom-logo', array(
    'width'       => 250,
    'height'      => 250,
    'flex-width'  => true,
    'flex-height' => true,
  ) );

  /*
   * This theme styles the visual editor to resemble the theme style,
   * specifically font, colors, and column width.
   */
  add_editor_style( array( 'assets/css/editor-style.css', education_insight_fonts_url() ) );

}
add_action( 'after_setup_theme', 'educate_training_coach_setup' );

function educate_training_coach_remove_parent_theme_locations(){
    unregister_nav_menu( 'primary-1' );
    unregister_nav_menu( 'primary-2' );
 }
 add_action( 'after_setup_theme', 'educate_training_coach_remove_parent_theme_locations', 20 );

function educate_training_coach_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Sidebar', 'educate-training-coach' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'educate-training-coach' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
    'after_title'   => '</h3></div>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Page Sidebar', 'educate-training-coach' ),
    'id'            => 'sidebar-2',
    'description'   => __( 'Add widgets here to appear in your pages and posts', 'educate-training-coach' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
    'after_title'   => '</h3></div>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Sidebar 3', 'educate-training-coach' ),
    'id'            => 'sidebar-3',
    'description'   => __( 'Add widgets here to appear in your sidebar on blog posts and archive pages.', 'educate-training-coach' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<div class="widget_container"><h3 class="widget-title">',
    'after_title'   => '</h3></div>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 1', 'educate-training-coach' ),
    'id'            => 'footer-1',
    'description'   => __( 'Add widgets here to appear in your footer.', 'educate-training-coach' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 2', 'educate-training-coach' ),
    'id'            => 'footer-2',
    'description'   => __( 'Add widgets here to appear in your footer.', 'educate-training-coach' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 3', 'educate-training-coach' ),
    'id'            => 'footer-3',
    'description'   => __( 'Add widgets here to appear in your footer.', 'educate-training-coach' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Footer 4', 'educate-training-coach' ),
    'id'            => 'footer-4',
    'description'   => __( 'Add widgets here to appear in your footer.', 'educate-training-coach' ),
    'before_widget' => '<section id="%1$s" class="widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'educate_training_coach_widgets_init' );

function educate_training_coach_enqueue_comments_reply() {
  if( is_singular() && comments_open() && ( get_option( 'thread_comments' ) == 1) ) {
    // Load comment-reply.js (into footer)
    wp_enqueue_script( 'comment-reply', '/wp-includes/js/comment-reply.min.js', array(), false, true );
  }
}
add_action(  'wp_enqueue_scripts', 'educate_training_coach_enqueue_comments_reply' );

function educate_training_coach_bn_custom_meta_offer() {
  add_meta_box( 'bn_meta', __( 'Courses Custom Feilds', 'educate-training-coach' ), 'educate_training_coach_meta_callback_courses', 'post', 'normal', 'high' );
}
/* Hook things in for admin*/
if (is_admin()){
  add_action('admin_menu', 'educate_training_coach_bn_custom_meta_offer');
}

function educate_training_coach_meta_callback_courses( $post ) {
  wp_nonce_field( basename( __FILE__ ), 'educate_training_coach_offer_courses_meta_nonce' );
  $educate_training_coach_bn_stored_meta = get_post_meta( $post->ID );
  $educate_training_coach_courses_amount = get_post_meta( $post->ID, 'educate_training_coach_courses_amount', true );
  $educate_training_coach_courses_lesson = get_post_meta( $post->ID, 'educate_training_coach_courses_lesson', true );
  $educate_training_coach_courses_student = get_post_meta( $post->ID, 'educate_training_coach_courses_student', true );
  ?>
  <table id="list">
    <tbody id="the-list" data-wp-lists="list:meta">
      <tr id="meta-8">
        <td class="left">
          <?php esc_html_e( 'Courses Amount', 'educate-training-coach' )?>
        </td>
        <td class="left">
          <input type="text" name="educate_training_coach_courses_amount" id="educate_training_coach_courses_amount" value="<?php echo esc_attr($educate_training_coach_courses_amount); ?>" />
        </td>
      </tr>
      <tr id="meta-8">
        <td class="left">
          <?php esc_html_e( 'Lessons', 'educate-training-coach' )?>
        </td>
        <td class="left">
          <input type="text" name="educate_training_coach_courses_lesson" id="educate_training_coach_courses_lesson" value="<?php echo esc_attr($educate_training_coach_courses_lesson); ?>" />
        </td>
      </tr>
      <tr id="meta-8">
        <td class="left">
          <?php esc_html_e( 'Students', 'educate-training-coach' )?>
        </td>
        <td class="left">
          <input type="text" name="educate_training_coach_courses_student" id="educate_training_coach_courses_student" value="<?php echo esc_attr($educate_training_coach_courses_student); ?>" />
        </td>
      </tr>
    </tbody>
  </table>
  <?php
}

/* Saves the custom meta input */
function educate_training_coach_custom_feild_save( $post_id ) {
  if (!isset($_POST['educate_training_coach_offer_courses_meta_nonce']) || !wp_verify_nonce( strip_tags( wp_unslash( $_POST['educate_training_coach_offer_courses_meta_nonce']) ), basename(__FILE__))) {
      return;
  }

  if (!current_user_can('edit_post', $post_id)) {
      return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
  }

  // Save Trip Amount
  if( isset( $_POST[ 'educate_training_coach_courses_amount' ] ) ) {
      update_post_meta( $post_id, 'educate_training_coach_courses_amount', strip_tags( wp_unslash( $_POST[ 'educate_training_coach_courses_amount' ]) ) );
  }
  // Save Trip Days
  if( isset( $_POST[ 'educate_training_coach_courses_lesson' ] ) ) {
      update_post_meta( $post_id, 'educate_training_coach_courses_lesson', strip_tags( wp_unslash( $_POST[ 'educate_training_coach_courses_lesson' ]) ) );
  }
  // Save Trip Days
  if( isset( $_POST[ 'educate_training_coach_courses_student' ] ) ) {
      update_post_meta( $post_id, 'educate_training_coach_courses_student', strip_tags( wp_unslash( $_POST[ 'educate_training_coach_courses_student' ]) ) );
  }
}
add_action( 'save_post', 'educate_training_coach_custom_feild_save' );

if ( ! defined( 'EDUCATE_TRAINING_COACH_PRO_LINK' ) ) {
  define('EDUCATE_TRAINING_COACH_PRO_LINK',__('https://www.ovationthemes.com/wordpress/education-coach-wordpress-theme/','educate-training-coach'));
}

if ( ! defined( 'EDUCATION_INSIGHT_SUPPORT' ) ) {
  define('EDUCATION_INSIGHT_SUPPORT',__('https://wordpress.org/support/theme/educate-training-coach','educate-training-coach'));
}
if ( ! defined( 'EDUCATION_INSIGHT_REVIEW' ) ) {
  define('EDUCATION_INSIGHT_REVIEW',__('https://wordpress.org/support/theme/educate-training-coach/reviews/','educate-training-coach'));
}
if ( ! defined( 'EDUCATION_INSIGHT_LIVE_DEMO' ) ) {
define('EDUCATION_INSIGHT_LIVE_DEMO',__('https://www.ovationthemes.com/demos/educate-training-coach/','educate-training-coach'));
}
if ( ! defined( 'EDUCATION_INSIGHT_BUY_PRO' ) ) {
define('EDUCATION_INSIGHT_BUY_PRO',__('https://www.ovationthemes.com/wordpress/training-coach-wordpress-theme/','educate-training-coach'));
}
if ( ! defined( 'EDUCATION_INSIGHT_PRO_DOC' ) ) {
define('EDUCATION_INSIGHT_PRO_DOC',__('https://ovationthemes.com/docs/ot-educate-training-coach-pro/','educate-training-coach'));
}
if ( ! defined( 'EDUCATION_INSIGHT_THEME_NAME' ) ) {
define('EDUCATION_INSIGHT_THEME_NAME',__('Premium Educate Theme','educate-training-coach'));
}

/* Pro control */
if (class_exists('WP_Customize_Control') && !class_exists('Educate_Training_Coach_Pro_Control')):
    class Educate_Training_Coach_Pro_Control extends WP_Customize_Control{

    public function render_content(){?>
        <label style="overflow: hidden; zoom: 1;">
            <div class="col-md upsell-btn">
                <a href="<?php echo esc_url( EDUCATE_TRAINING_COACH_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE EDUCATE PREMIUM','educate-training-coach');?> </a>
            </div>
            <div class="col-md">
                <img class="educate_training_coach_img_responsive " src="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/screenshot.png">
            </div>
            <div class="col-md">
                <h3 style="margin-top:10px; margin-left: 20px; text-decoration:underline; color:#333;"><?php esc_html_e('EDUCATE TRAINING PREMIUM - Features', 'educate-training-coach'); ?></h3>
                <ul style="padding-top:10px">
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Responsive Design', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Boxed or fullwidth layout', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Shortcode Support', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Demo Importer', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Section Reordering', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Contact Page Template', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Multiple Blog Layouts', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Unlimited Color Options', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Designed with HTML5 and CSS3', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Customizable Design & Code', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Cross Browser Support', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Detailed Documentation Included', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Stylish Custom Widgets', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Patterns Background', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('WPML Compatible (Translation Ready)', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Woo-commerce Compatible', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Full Support', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('10+ Sections', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Live Customizer', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('AMP Ready', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Clean Code', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('SEO Friendly', 'educate-training-coach');?> </li>
                    <li class="upsell-educate_training_coach"> <div class="dashicons dashicons-yes"></div> <?php esc_html_e('Supper Fast', 'educate-training-coach');?> </li>
                </ul>
            </div>
            <div class="col-md upsell-btn upsell-btn-bottom">
                <a href="<?php echo esc_url( EDUCATE_TRAINING_COACH_PRO_LINK ); ?>" target="blank" class="btn btn-success btn"><?php esc_html_e('UPGRADE EDUCATE PREMIUM','educate-training-coach');?> </a>
            </div>
        </label>
    <?php } }
endif;
