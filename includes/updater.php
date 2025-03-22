<?php

class Makler_Plus_Updater {
    private $plugin_file;
    private $plugin_slug = 'makler-plus/makler-plus.php';
    private $github_user = 'boow-media';
    private $github_repo = 'makler-plus';
    private $github_zip_name = 'makler-plus.zip';

    public function __construct($plugin_file) {
        $this->plugin_file = $plugin_file;

        add_filter('pre_set_site_transient_update_plugins', [$this, 'check_for_updates']);
        add_filter('plugins_api', [$this, 'plugin_info'], 10, 3);
        add_action('admin_init', [$this, 'force_check']);
    }

    public function check_for_updates($transient) {
        if (empty($transient->checked)) return $transient;

        $request = wp_remote_get("https://api.github.com/repos/{$this->github_user}/{$this->github_repo}/releases/latest", [
            'headers' => ['User-Agent' => 'WordPress']
        ]);

        if (is_wp_error($request)) return $transient;

        $release = json_decode(wp_remote_retrieve_body($request));
        if (!empty($release->tag_name)) {
            $current_version = get_plugin_data($this->plugin_file)['Version'];
            $latest_version = ltrim($release->tag_name, 'v');

            if (version_compare($current_version, $latest_version, '<')) {
                $zip_url = "https://github.com/{$this->github_user}/{$this->github_repo}/releases/download/{$release->tag_name}/{$this->github_zip_name}";

                $transient->response[$this->plugin_slug] = (object) [
                    'slug' => 'makler-plus',
                    'new_version' => $latest_version,
                    'package' => $zip_url,
                    'url' => $release->html_url
                ];
            }
        }

        return $transient;
    }

    public function plugin_info($false, $action, $args) {
        if ($action !== 'plugin_information' || $args->slug !== 'makler-plus') return $false;

        $request = wp_remote_get("https://api.github.com/repos/{$this->github_user}/{$this->github_repo}/releases/latest", [
            'headers' => ['User-Agent' => 'WordPress']
        ]);

        if (is_wp_error($request)) return $false;

        $release = json_decode(wp_remote_retrieve_body($request));

        return (object) [
            'name' => 'Makléř+',
            'slug' => 'makler-plus',
            'version' => ltrim($release->tag_name, 'v'),
            'author' => 'Boow Media',
            'download_link' => "https://github.com/{$this->github_user}/{$this->github_repo}/releases/download/{$release->tag_name}/{$this->github_zip_name}",
            'sections' => ['description' => 'Plugin pro správu nemovitostí s automatickými aktualizacemi přes GitHub.']
        ];
    }

    public function force_check() {
        delete_site_transient('update_plugins');
        wp_update_plugins();
    }
}

// ✅ Spuštění
new Makler_Plus_Updater(plugin_dir_path(__DIR__) . 'makler-plus.php');

// ✅ Reset při aktivaci
register_activation_hook(__FILE__, function () {
    delete_site_transient('update_plugins');
    wp_update_plugins();
});