<?php
/**
 * Inform a theme user of plugins that will extend their theme's functionality.
 *
 * @link https://github.com/Automattic/theme-tools/
 *
 * @package RedRock
 */

class RedRock_Theme_Plugin_Enhancements {
	var $plugins;
	var $display_notice = false;
	
	static function init() {
		static $instance = false;

		if (! $instance) {
			$instance = new RedRock_Theme_Plugin_Enhancements;
		}

		return $instance;
	}
	
	function __construct() {
		$screen = get_current_screen();
		if (! in_array($screen->base, array('dashboard', 'themes', 'plugins'))) {
			return;
		}
		
		$this->dependencies = $this->get_theme_dependencies();
		
		if (empty($this->dependencies))
			return;

		$dependency_list = '';
		$this->modules = array();
		
		foreach ($this->dependencies as $dependency):
			if ('none' !== $dependency['module']) :
				$this->modules[ $dependency['name'] ] = $dependency['module'];
			endif;
			
			$dependency_list .= $dependency['name'] . ' (' . $this->get_module_name($dependency['module']) . '), ';
		endforeach;
		
		$this->plugins = array(
			array(
				'slug'    => 'jetpack',
				'name'    => 'Jetpack by WordPress.com',
				'message' => sprintf(
					'The %1$s is necessary to use some of this theme&rsquo;s features, including: ',
					'<strong>' . 'Jetpack plugin' . '</strong>'),
				'modules' => rtrim($dependency_list, ', ') . '.',
			),
		);
		
		$this->set_plugin_status();
		$this->set_module_status();
		
		if ($this->display_notice && current_user_can('install_plugins')) {
			add_action('admin_notices', array($this, 'admin_notices'));
		}
	}
	
	function get_theme_dependencies() {
		$dependencies = array();

		if (current_theme_supports('site-logo')) :
			$dependencies['logo'] = array(
				'name' => esc_html__('Site Logo', 'redrock'),
				'slug' => 'site-logo',
				'url'  => '',
				'module' => 'none',
			);
		endif;

		if (current_theme_supports('featured-content')) :
			$dependencies['featured-content'] = array(
				'name' => esc_html__('Featured Content', 'redrock'),
				'slug' => 'featured-content',
				'url'  => '',
				'module' => 'none',
			);
		endif;

		if (current_theme_supports('jetpack-social-menu')) :
			$dependencies['social-menu'] = array(
				'name' => esc_html__('Social Menu', 'redrock'),
				'slug' => 'jetpack-social-menu',
				'url'  => '',
				'module' => 'none',
			);
		endif;

		if (current_theme_supports('nova_menu_item')) :
			$dependencies['menus'] = array(
				'name' => esc_html__('Menus', 'redrock'),
				'slug' => 'nova_menu_item',
				'url'  => '',
				'module' => 'custom-content-types',
			);
		endif;

		if (current_theme_supports('jetpack-comic')) :
			$dependencies['comics'] = array(
				'name' => esc_html__('Comics', 'redrock'),
				'slug' => 'jetpack-comic',
				'url'  => '',
				'module' => 'custom-content-types',
			);
		endif;

		if (current_theme_supports('jetpack-testimonial')) :
			$dependencies['testimonials'] = array(
				'name' => esc_html__('Testimonials', 'redrock'),
				'slug' => 'jetpack-testimonial',
				'url'  => '',
				'module' => 'custom-content-types',
			);
		endif;

		if (current_theme_supports('jetpack-portfolio')) :
			$dependencies['portfolios'] = array(
				'name' => esc_html__('Portfolios', 'redrock'),
				'slug' => 'jetpack-portfolio',
				'url'  => '',
				'module' => 'custom-content-types',
			);
		endif;

		if (current_theme_supports('jetpack-content-options')) :
			$dependencies['content-options'] = array(
				'name' => esc_html__('Content Options', 'redrock'),
				'slug' => 'jetpack-content-options',
				'url'  => '',
				'module' => 'none',
			);
		endif;

		return $dependencies;
	}
	
	function get_module_name($module) {
		$module_names = array(
			'none'                 => esc_html__('no specific module needed', 'redrock'),
			'custom-content-types' => esc_html__('Custom Content Types module', 'redrock'),
		);
		return $module_names[ $module ];
	}
	
	function set_plugin_status() {
		$installed_plugin_names = wp_list_pluck(get_plugins(), 'Name');

		foreach ($this->plugins as $key => $plugin) {
			if (in_array($plugin['name'], $installed_plugin_names)) {
				if (is_plugin_active(array_search($plugin['name'], $installed_plugin_names))) {
					unset($this->plugins[ $key ]);
				}
				else {
					$this->plugins[ $key ]['status'] = 'to-activate';
					$this->display_notice = true;
				}
			}
			else {
				$this->plugins[ $key ]['status'] = 'to-install';
				$this->display_notice = true;
			}
		}
	}
	
	function set_module_status() {
		$this->unactivated_modules = array();
		
		foreach ($this->modules as $feature => $module) :
			if (class_exists('Jetpack') && ! Jetpack::is_module_active($module)):
				$this->unactivated_modules[ $module ][] = $feature;
				$this->display_notice = true;

			endif;
		endforeach;

	}
	
	function admin_notices() {
		if (get_user_meta(get_current_user_id(), 'redrock_jetpack_admin_notice', true) === 'dismissed') {
			return;
		}

		$notice = '';
		
		foreach ($this->plugins as $key => $plugin) {
			$notice .= '<p>';
			
			if (isset($plugin['message'])) {
				$notice .= $plugin['message'];
				$notice .= esc_html($plugin['modules']);
			}
			
			if ('to-activate' === $plugin['status']) {
				$activate_url = $this->plugin_activate_url($plugin['slug']);
				$notice .= sprintf(
					esc_html__(' Please activate %1$s. %2$s', 'redrock'),
					esc_html($plugin['name']),
					($activate_url) ? '<a href="' . $activate_url . '">' . esc_html__('Activate', 'redrock') . '</a>' : ''
				);
			}
			
			if ('to-install' === $plugin['status']) {
				$install_url = $this->plugin_install_url($plugin['slug']);
				$notice .= sprintf(
					esc_html__(' Please install %1$s. %2$s', 'redrock'),
					esc_html($plugin['name']),
					($install_url) ? '<a href="' . $install_url . '">' . esc_html__('Install', 'redrock') . '</a>' : ''
				);
			}

			$notice .= '</p>';
		}
		
		foreach ($this->unactivated_modules as $module => $features):
			$featurelist = array();
			foreach ($features as $feature) {
				$featurelist[] = $feature;
			}

			if (2 === count($featurelist)) {
				$featurelist  = implode(' or ', $featurelist);
			} elseif (1 < count($featurelist)) {
				$last_feature = array_pop($featurelist);
				$featurelist  = implode(', ', $featurelist) . ', or ' . $last_feature;
			} else {
				$featurelist  = implode(', ', $featurelist);
			}

			$notice .= '<p>';
			$notice .= sprintf(
				esc_html__('To use %1$s, please activate the Jetpack plugin&rsquo;s %2$s.', 'redrock'),
				esc_html($featurelist),
				'<strong>' . esc_html($this->get_module_name($module)) . '</strong>'
			);
			$notice .= '</p>';
		endforeach;
		
		$allowed = array(
			'p'      => array(),
			'strong' => array(),
			'em'     => array(),
			'b'      => array(),
			'i'      => array(),
			'a'      => array('href' => array()),
		);
		printf(
			'<div id="jetpack-notice" class="notice notice-warning is-dismissible">%s</div>',
			wp_kses($notice, $allowed)
		);
	}
	
	function plugin_activate_url($slug) {
		$plugin_paths = array_keys(get_plugins());
		$plugin_path  = false;

		foreach ($plugin_paths as $path) {
			if (preg_match('|^' . $slug .'|', $path)) {
				$plugin_path = $path;
			}
		}

		if (! $plugin_path) {
			return false;
		} else {
			return wp_nonce_url(
				self_admin_url('plugins.php?action=activate&plugin=' . $plugin_path),
				'activate-plugin_' . $plugin_path
			);
		}
	}
	
	function plugin_install_url($slug) {
		include_once ABSPATH . 'wp-admin/includes/plugin-install.php';

		$plugin_information = plugins_api('plugin_information', array('slug' => $slug));

		if (is_wp_error($plugin_information)) {
			return false;
		}
		else {
			return wp_nonce_url(
				self_admin_url('update.php?action=install-plugin&plugin=' . $slug),
				'install-plugin_' . $slug
			);
		}
	}
}
add_action('admin_head', array('RedRock_Theme_Plugin_Enhancements', 'init'));

function redrock_enqueue_scripts() {
	if (is_admin() && get_user_meta(get_current_user_id(), 'redrock_jetpack_admin_notice', true) !== 'dismissed') {
		wp_enqueue_script('redrock_jetpack_admin_script', get_template_directory_uri() . '/inc/plugin-enhancements.js', array('jquery'), '20160624', true);
		
		wp_localize_script('redrock_jetpack_admin_script', 'redrock_jetpack_admin', array(
			'redrock_jetpack_admin_nonce' => wp_create_nonce('redrock_jetpack_admin_nonce'),
		));
	}
}
add_action('admin_enqueue_scripts', 'redrock_enqueue_scripts');

function redrock_dismiss_admin_notice() {
	if (!isset($_POST['redrock_jetpack_admin_nonce']) || !wp_verify_nonce($_POST['redrock_jetpack_admin_nonce'], 'redrock_jetpack_admin_nonce')) {
		wp_die(__('Your request failed permission check.', 'redrock'));
	}
	
	update_user_meta(get_current_user_id(), 'redrock_jetpack_admin_notice', 'dismissed');
	
	wp_send_json(array(
		'status' => 'success',
		'message' => __('Your request was processed. See ya!', 'redrock')
	));
}
add_action('wp_ajax_redrock_jetpack_admin_notice', 'redrock_dismiss_admin_notice');