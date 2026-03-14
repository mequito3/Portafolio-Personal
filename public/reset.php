<?php
opcache_reset();
if (function_exists('apcu_clear_cache')) {
    apcu_clear_cache();
}
echo "OPcache and APCu cleared successfully.";
