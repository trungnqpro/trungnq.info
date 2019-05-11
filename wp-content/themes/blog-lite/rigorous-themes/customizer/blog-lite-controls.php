<?php
if ( ! class_exists( 'WP_Customize_Control' ) ) {
  return NULL;
}

/**
 * Blog Lite Customize Category Control.
 */

if (class_exists('WP_Customize_Control') && ! class_exists( 'Blog_Lite_Customize_Category_Control' ) ) {

    class Blog_Lite_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         *
         * @since 3.4.0
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => 'blog-lite-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( '&mdash; Select &mdash;', 'blog-lite' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                    'hide_empty'        => 0,                   

                )
            ); 
            
            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );
 
            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s <span class="description customize-control-description"></span>%s </label>',
                esc_html($this->label),
                esc_html($this->description),
                $dropdown

            );
        }
    }
}

/**
 * Blog Lite Customize sidebar layout control.
 */

if (class_exists('WP_Customize_Control') && ! class_exists( 'Blog_Lite_Customize_Sidebar_Control' ) ) {

    class Blog_Lite_Customize_Sidebar_Control extends WP_Customize_Control {
        public function render_content() {

            if ( empty( $this->choices ) )
                return;

            $name = '_customize-radio-' . $this->id;

            ?>
            <style>
                #blog-lite-layouts-container li {
                    float: left;
                    display: inline;
                    text-align: left;
                    width: 45%;
                    margin-left: 12px;
                }
                              
                #blog-lite-layouts-container li img.blog-lite-sidebar-img {         
                   cursor: pointer;   
                   border: 3px solid #E4E4E4; 
                   border-radius: 3px;
                    -moz-border-radius: 3px;
                    -webkit-border-radius: 3px;              
                }

                #blog-lite-layouts-container li img.blog-lite-sidebar-img-selected {
                    border: 3px solid #BCBCBC;                    
                }
                
            </style>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <ul class="controls" id='blog-lite-layouts-container'>
            <?php
                foreach ( $this->choices as $value => $label ) :

                    $class = ($this->value() == $value) ? 'blog-lite-sidebar-img-selected blog-lite-sidebar-img' : 'blog-lite-sidebar-img';
                    ?>
                    <li>
                    <label>
                        <input <?php $this->link(); ?>style = 'display:none' type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
                        <img src = '<?php echo esc_html( $label ); ?>' class = '<?php echo esc_attr($class); ?>' />
                    </label>
                    </li>
                    <?php
                endforeach;
            ?>
            </ul>
            <script type="text/javascript">

                jQuery(document).ready(function($) {
                    $('#blog-lite-layouts-container li label img').click(function(){
                        $('#blog-lite-layouts-container li').each(function(){
                            $(this).find('img').removeClass ('blog-lite-sidebar-img-selected') ;
                        });
                        $(this).addClass ('blog-lite-sidebar-img-selected') ;
                    });                    
                });

            </script>
            <?php
        }
    }
}
