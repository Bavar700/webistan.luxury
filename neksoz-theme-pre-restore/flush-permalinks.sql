UPDATE wp_options SET option_value = '/%postname%/' WHERE option_name = 'permalink_structure';
DELETE FROM wp_options WHERE option_name = 'rewrite_rules';
