<?php

require_once 'ZTLAdminController.php';
require_once ZTL_PLUGIN_PATH . 'Lib/ZTLLandingPageRenderer.php';

if (!class_exists('ZTLAdminLandingPagesController')) {
	class ZTLAdminLandingPagesController extends ZTLAdminController {
		protected $landingPage;

		public function doIndex() {
			// TODO make per page a reasonable value and centralize it. Perhaps we could use screen options
			//      to allow the user to set this like they can per-page for posts?
			//      cf http://codex.wordpress.org/Function_Reference/add_screen_option
			$perPage = 10;
			$offset = $perPage * (isset($this->input->get['paged']) ? intval($this->input->get['paged']) - 1 : 0);

			// TODO look at generalizing pagination so that it can be re-used and we can cleanup this controller.
			$count = ZTLPluginLandingPage::count();
			$totalPages = ceil($count / $perPage);

			$landingPages = ZTLPluginLandingPage::find('all', array(
				'limit' => $perPage,
				'offset' => $offset,
				'order' => 'name'
			));

			$currentLandingPagesActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => array('date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY) AND "' . date('Y-m-d') . '" AND type = ?' , array('landing_page'))
				));
			$prevLandingPagesActivity = ZTLPluginActivity::find('all' , array(
				'conditions' => array('date BETWEEN DATE_SUB("' . date('Y-m-d') . '", INTERVAL 14 DAY) AND DATE_SUB("' . date('Y-m-d') . '", INTERVAL 7 DAY)' , array('landing_page'))
				));

			$params = array(
				'landing_pages' => $landingPages,
				'landing_page_activity' => $currentLandingPagesActivity,
				'prev_landing_page_activity' => $prevLandingPagesActivity,
				'landing_page_count' => $count,
				'pagination' => $this->adminPaginateLinks($totalPages)
			);

			echo $this->view->render('admin/landing_pages/index.twig',
										array_merge(
											$params, 
											array('user'=>$this->getUserData())
										));
		}

		public function preEdit() {
			if (!empty($this->input->get['id'])) {
				$id = $this->input->get['id'];
			} elseif (!empty($this->input->post['landing_page']['id'])) {
				$id = $this->input->post['landing_page']['id'];
			}

			if (!empty($id)) {
				try {
					$this->landingPage = ZTLPluginLandingPage::find($id);
				} catch (ActiveRecord\RecordNotFound $e) {
					// TODO add flash message?
					wp_redirect($this->adminPageUrl());
					exit;
				}
			} else {
				$this->landingPage = new ZTLPluginLandingPage();
			}

			if ('POST' == $_SERVER['REQUEST_METHOD']) {
				check_admin_referer($this->modelNonceAction($this->landingPage, 'update'));
				$this->landingPage->update_attributes($this->input->post['landing_page']);
			}
		}

		/**
		 * Display the LP file for a specific theme, for editing
		 */
		static public function render_landing_page_for_edit($param){
			$renderer = new ZTLLandingPageRenderer();
            $landingPage = new ZTLPluginLandingPage;
            $landingPage->header = '<h1 class="center">Get specific tips on landing your<br> <strong>dream job</strong> in months instead of years</h1>'
			    . '<p class="from-ramit center">- From New York Times Best Selling Author, <strong>Ramit Sethi</strong>  -</p>';
            $landingPage->body = '<img class="ramit-inline-left" data-toggle="editable" src="http://www.iwillteachyoutoberich.com/dreamjob-partner-page/images/ramit.png" alt="">
                <p>One of the things I\'ve been quietly working on lately is helping people find their dream jobs</p>
				<p>In fact, I\'ve been helping people crush interviews, negotiate salaries, and find what they love to do since my sophomore year of college -- and keeping detailed notes on every technique I use.</p>
				<p>And now it\'s time to start revealing some of them.</p>
				<p>Today, I invite you to sign up for my <strong>Dream Job Insider\'s List</strong>. Here\'s just some of what I\'ll be sending you in the coming weeks and months:</p>
				<ul>
					<li>How to find out what you LOVE to do -- and would be profitable</li>
					<li>Psychological techniques for outshining competing job applicants (like how I beat out 5+ Stanford business-school students for a job...as a sophomore)</li>
					<li>Direct answers to the toughest interview questions</li>
					<li>Often ignored techniques to instantly make your resume shine</li>
					<li>“Before and after” commentary on interviews that succeeded and failed</li>
					<li>Tear-downs of real resumes from my students</li>
				</ul>
				<p><strong>Sign up for free to get started <span class="hide highlight">&rarr;</span><span class="show highlight">&darr;</span></strong></p>';
            $landingPage->logo_url = 'http://www.iwillteachyoutoberich.com/dreamjob-partner-page/images/iwt-logo.png';
            $landingPage->optin_form_id = null;
            $landingPage->theme = $param['theme'];

            echo $renderer->render($landingPage,
                array('editing' => !empty($param['editing']))
            );
			exit();
		}

        static public function render_landing_page($slug){
            $landingPage = ZTLPluginLandingPage::find_by_slug($slug);
            $optinForm = ZTLPluginOptinForm::find($landingPage->optin_form_id);
            $renderer = new ZTLLandingPageRenderer();
            echo $renderer->render($landingPage, array(
                'optinForm' => $optinForm
            ));
            exit();
        }

		public function doEdit() {
			$errors = array();

			$themes = ZTLPluginLandingPage::availableThemes();
			$selected_theme = $this->landingPage->theme;

			if (!in_array($selected_theme, $themes)) {
				$selected_theme = $themes[0];
			}

			$params = array(
				'themes' => $themes,
				'selected_theme' => $selected_theme,
				'optin_forms' => ZTLPluginOptinForm::find('all'),
				'landing_page' => $this->landingPage,
				'errors' => $errors
			);

			echo $this->view->render('admin/landing_pages/edit.twig',
										array_merge(
											$params,
											array('user'=>$this->getUserData())
										));
		}

		public function doConfirmDelete() {
			try {
				$this->landingPage = ZTLPluginLandingPage::find($this->input->post['id']);
			} catch (ActiveRecord\RecordNotFound $e) {
				// No need to confirm the deletion of a non-existant record
				wp_redirect($this->adminPageUrl());
				exit;
			}

			check_admin_referer($this->modelNonceAction($this->landingPage, 'delete'));

			echo $this->view->render(
				'admin/landing_pages/confirm_delete.twig',
				array('landing_page' => $this->landingPage));
		}

		public function preDelete() {
			if (empty($this->input->post['id'])) {
				wp_redirect($this->adminPageUrl());
				exit;
			}

			try {
				$this->landingPage = ZTLPluginLandingPage::find($this->input->post['id']);

				check_admin_referer($this->modelNonceAction($this->landingPage, 'delete'));

				$this->landingPage->delete();
			} catch (ActiveRecord\RecordNotFound $e) {
				// Do nothing here since the original intent was to delete the optin form anyway.
			}

			// TODO add flash message?
			wp_redirect($this->adminPageUrl());
			exit;
		}
	}
}
