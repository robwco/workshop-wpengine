<?php

class ZTLOptinWidgetController extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'ZTLWidget', // Base ID
			__('Zero To Launch', 'text_domain'), // Name
			array( 'description' => __( 'Select the Opt-in form to display in various area on your site.', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget($args, $instance) {
		require_once 'ZTLOptinFormRenderer.php';

		$render = new ZTLOptinFormRenderer();

		$optin_id = $instance['optin_id'];

		$title = apply_filters('widget_title', $instance['title']);

		if (!empty($optin_id)) {
			try {
				$optinForm = ZTLPluginOptinForm::find($optin_id);
			} catch (ActiveRecord\RecordNotFound $e) {
				// Optin ID not found, so it's better not to show anything
				return;
			}
		} else {
			// Optin ID not specified, so don't show anything
			return;
		}

		echo $render->render($optinForm, array(
			'source' => 'widget',
			'widget_title' => $title
		));
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return null
	 */
	public function form($instance) {

		$title = isset($instance['title']) ? $title = $instance['title'] : __('New title', 'zerotolaunch');

		$optinForms = ZTLPluginOptinForm::all();
		?>
		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
		</p>
		<p>
			<p style="font-size: .875em;margin-bottom: .3em">Select an Opt-in Form:</p>
			<select name="<?php echo $this->get_field_name('optin_id'); ?>" class="widefat">
				<?php
					foreach ( $optinForms as $form )
					{
						$selected = $instance['optin_id'] == $form->id ? 'selected="selected"' : '';
						echo '<option value="' . $form->id . '"'. $selected .'>'. $form->name.'</option>';
					}
				?>
			</select>
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update($new_instance, $old_instance) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['optin_id'] = ( ! empty( $new_instance['optin_id'] ) ) ? strip_tags( $new_instance['optin_id'] ) : '';

		return $instance;
	}

} // class Foo_Widget
