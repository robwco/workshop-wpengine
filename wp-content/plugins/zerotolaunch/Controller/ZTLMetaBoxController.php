<?php

require_once 'ZTLAppController.php';

class ZTLMetaBoxController extends ZTLAppController {
	public static function register($ztlInput) {

	}

	protected function setupViewHelpers() {
		parent::setupViewHelpers();

		$this->view->addFunction('metabox_nonce_field', array(&$this, 'metaBoxNonceField'));
	}

	/**
	 * Checks if the submitted form should be processed or not. This doesn't
	 * check the validity of the data, just whether the form was properly submitted.
	 *
	 * @param $metaBoxName The name of the meta box. Must match the name that the view metabox_nonce_field uses.
	 * @param $postId The ID of the post that this metabox is associated with.
	 * @return bool true if the form is okay to process, false if not.
	 */
	protected function isSubmittalAllowed($metaBoxName, $postId) {
		$nonceField = $this->nonceFieldName($metaBoxName);

		if (!isset($_POST[$nonceField])) {
			return false;
		}

		// verify nonce
		if (!wp_verify_nonce($_POST[$nonceField], $metaBoxName)) {
			return false;
		}

		// Check to make sure that we're actually being saved, not just autosaved
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return false;
		}

		// Check for permission to edit
		if (!current_user_can('edit_post', $postId)) {
			return false;
		}

		return true;
	}

	/**
	 * @param $metaBoxName The name of the metabox that this nonce field belongs to. Must match isSubmittalAllowed name.
	 * @return string An HTML fragment containing the nonce-related fields.
	 */
	public function metaBoxNonceField($metaBoxName) {
		return wp_nonce_field($metaBoxName, $this->nonceFieldName($metaBoxName));
	}

	/**
	 * Create a name for the nonce field specific to the specified metabox.
	 *
	 * @param $metaBoxName The name of the metabox. Must match the name provided to isSubmittalAllowed
	 * @return string The name of the nonce form field
	 */
	protected function nonceFieldName($metaBoxName) {
		return $metaBoxName . '_nonce';
	}
}
