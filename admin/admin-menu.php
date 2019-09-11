<?php
require_once OGHAT_PLUGIN_DIR . '/libs/admin-page-framework/admin-page-framework.php';
require_once OGHAT_PLUGIN_DIR . '/admin/times.php';
require_once OGHAT_PLUGIN_DIR . '/admin/settings.php';
require_once OGHAT_PLUGIN_DIR . '/admin/locations.php';
class OghatAdminMenu extends LazyCoala_AdminPageFramework {
    public function setUp()
    {
        $this->setRootMenuPage('اوقات شرعی');
        $this->addSubMenuItems(
            array(
                'title'     => 'تنظیمات',
                'page_slug' => 'oghat_settings'
            ),
            array(
                'title'     => 'مدیریت مناطق',
                'page_slug' => 'oghat_manage_locations'
            ),
            array(
                'title'     => 'زمان های دستی',
                'page_slug' => 'oghat_manage_times'
            )
        );
    }
}
new OghatAdminMenu();
