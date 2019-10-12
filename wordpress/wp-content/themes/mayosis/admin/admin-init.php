<?php
if (file_exists(get_template_directory() . '/admin/tgm/tgm-init.php')) {
    require_once get_template_directory() . '/admin/tgm/tgm-init.php';
}

if (file_exists(get_template_directory() . '/admin/theme-panel/mayosis-studio.php')) {
    require_once get_template_directory() . '/admin/theme-panel/mayosis-studio.php';
}
if (file_exists(get_template_directory() . '/admin/theme-panel/header-options.php')) {
    require_once get_template_directory() . '/admin/theme-panel/header-options.php';
}

if (file_exists(get_template_directory() . '/admin/theme-panel/product-options.php')) {
    require_once get_template_directory() . '/admin/theme-panel/product-options.php';
}

if (file_exists(get_template_directory() . '/admin/theme-panel/footer-options.php')) {
    require_once get_template_directory() . '/admin/theme-panel/footer-options.php';
}
if (file_exists(get_template_directory() . '/admin/theme-panel/typography.php')) {
    require_once get_template_directory() . '/admin/theme-panel/typography.php';
}

if (file_exists(get_template_directory() . '/admin/theme-panel/template.php')) {
    require_once get_template_directory() . '/admin/theme-panel/template.php';
}

if (file_exists(get_template_directory() . '/admin/theme-panel/white-label.php')) {
    require_once get_template_directory() . '/admin/theme-panel/white-label.php';
}

if (file_exists(get_template_directory() . '/admin/admin-pages/admin.php')) {
    require_once get_template_directory() . '/admin/admin-pages/admin.php';
}

