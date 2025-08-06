<?php

class MV_Testimonials_Widget extends WP_Widget
{
    public function __construct()
    {
        $widget_options = array(
            'description' => 'Your most beloved testimonials'
        );

        parent::__construct(
            'mv-testimonials',
            'MV Testimonials',
            $widget_options
        );

        add_action(
            'widgets_init',
            function () {
                register_widget(
                    'MV_Testimonials_Widget'
                );
            }
        );

        if (is_active_widget(false, false, $this->id_base)) {
            add_action('wp_enqueue_scripts', array($this, 'enqueue'));
        }
    }

    public function enqueue()
    {
        wp_enqueue_style(
            'mv-testimonials-style-css',
            MV_TESTIMONIALS_URL . 'assets/css/frontend.css',
            array(),
            MV_TESTIMONIALS_VERSION,
            'all'
        );
    }

    // Método widget exibe o conteúdo no Backend
    // $instance array com informações do banco de dados
    public function form($instance)
    {
        $title     = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $number    = isset($instance['number']) ? absint($instance['number']) : 5;
        $image = isset($instance['image']) ? (bool) $instance['image'] : false;
        $occupation = isset($instance['occupation']) ? (bool) $instance['occupation'] : true;
        $company = isset($instance['company']) ? (bool) $instance['company'] : true;
?>
        <p>
            <label for="<?= $this->get_field_id('title') ?>"><?= esc_html__('Title', 'mv-testimonials') ?>:</label>
            <input class="widefat" id="<?= $this->get_field_id('title') ?>" name="<?= $this->get_field_name('title'); ?>" type="text" value="<?= $title ?>" />
        </p>

        <p>
            <label for="<?= $this->get_field_id('number') ?>"><?= esc_html__('Number of testimonials to show', 'mv-testimonials') ?>:</label>
            <input class="tiny-text" id="<?= $this->get_field_id('number') ?>" name="<?= $this->get_field_name('number'); ?>" type="number" step="1" min="1" size="3" value="<?= $number ?>" />
        </p>

        <p>
            <input class="checkbox" id="<?= $this->get_field_id('image') ?>" name="<?= $this->get_field_name('image'); ?>" type="checkbox" <?php checked($image) ?>/>
            <label for="<?= $this->get_field_id('image') ?>"><?= esc_html__('Display user image?', 'mv-testimonials') ?></label>
        </p>

        <p>
            <input class="checkbox" id="<?= $this->get_field_id('occupation') ?>" name="<?= $this->get_field_name('occupation'); ?>" type="checkbox" <?php checked($occupation) ?>/>
            <label for="<?= $this->get_field_id('occupation') ?>"><?= esc_html__('Display occupation?', 'mv-testimonials') ?></label>
        </p>

        <p>
            <input class="checkbox" id="<?= $this->get_field_id('company') ?>" name="<?= $this->get_field_name('company'); ?>" type="checkbox" <?php checked($company) ?>/>
            <label for="<?= $this->get_field_id('company') ?>"><?= esc_html__('Display company?', 'mv-testimonials') ?></label>
        </p>
<?php
    }

    // Método widget exibe o conteúdo no frontend
    // $args contem as tags html do widget
    public function widget($args, $instance) {
        $default_title = 'MV Testimonials';
        $title = ! empty($instance['title']) ? $instance['title'] : $default_title;
        $number = ! empty($instance['number']) ? $instance['number'] : 5;
        $image = ! empty($instance['image']) ? $instance['image'] : false;
        $occupation = ! empty($instance['occupation']) ? $instance['occupation'] : false;
        $company = ! empty($instance['company']) ? $instance['company'] : false;

        echo $args['before_widget'];
        echo $args['before_title'] . $title . $args['after_title'];      
        require(MV_TESTIMONIALS_PATH . 'views/mv-testimonials_widget.php');  
        echo $args['after_widget'];
    }

    // Atualização no banco de dados    
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = sanitize_text_field($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['image'] = !empty($new_instance['image']) ? 1 : 0;
        $instance['occupation'] = !empty($new_instance['occupation']) ? 1 : 0;
        $instance['company'] = !empty($new_instance['company']) ? 1 : 0;

        return $instance;
    }
}
