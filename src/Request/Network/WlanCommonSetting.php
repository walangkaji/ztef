<?php

namespace ZteF\Request\Network;

use ZteF\Request;

class WlanCommonSetting extends Request
{
    /**
     * WiFi Restrictions.
     *
     * Enable or disable scheduled RF control,
     * and configure off time and on time.
     * If scheduled RF control is enabled,
     * setting radio status manually is invalid.
     */
    public function wifiRestrictions(): void
    {
    }
}
