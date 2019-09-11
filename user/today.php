<?php
function show_today_prayer_times($args)
{
    $selected = $args['selected'];
    $locations = get_option('oghat_locations');
    if($locations != false)
    {
        $location = $locations[$selected];
        $method = $location['method'];
        require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/DMath.php');
        require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/Method.php');
        require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/PrayerTimes.php');
        if(!function_exists('jdate'))
        {
            require_once(OGHAT_PLUGIN_DIR . '/libs/jdate/jdf.php');
        }
        $pt = new IslamicNetwork\PrayerTimes\PrayerTimes($method);
        $custom_date = jdate('Y','','','','en').'-'.jdate('n','','','','en').'-'.jdate('j','','','','en');
        if(isset($location['times'][$custom_date]))
        {
            $raw_items = $location['times'][$custom_date];
            $times = array('Fajr' => $raw_items['fajr'],'Sunrise' => $raw_items['sunrise'], 'Dhuhr' => $raw_items['dhuhr'],'Sunset' => $raw_items['sunset'],'Maghrib' => $raw_items['maghrib'], 'Midnight' => $raw_items['midnight']);
        }
        else
        {
            $times = $pt->getTimesForToday(floatval($location['lat']), floatval($location['long']), $location['time_zone'], null, IslamicNetwork\PrayerTimes\PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE, IslamicNetwork\PrayerTimes\PrayerTimes::MIDNIGHT_MODE_STANDARD, IslamicNetwork\PrayerTimes\PrayerTimes::TIME_FORMAT_24H);
        }
        $locations_string = null;
        foreach($locations as $key=>$value)
        {
            if($key == $selected)
            {
                $locations_string .= '<option selected="selected" value="'.$key.'">'.$key.'</option>';
            }
            else
            {
                $locations_string .= '<option value="'.$key.'">'.$key.'</option>';
            }    
        }
        if(!get_option('OghatAdminMenu')['show_d_date'] && get_option('OghatAdminMenu')['show_d_jdate'])
        {
            $date_string = ' امروز ';
            $date_string .= jdate( 'j F Y' , '' , '' , '' , '' );
        }
        else if(get_option('OghatAdminMenu')['show_d_date'] && !get_option('OghatAdminMenu')['show_d_jdate'])
        {
            $date_string = ' امروز ';
            $date_string .= '<div class="fix-date">';
            $date_string .= date('j F Y');
            $date_string .= '</div>';
        }
        else
        {
            $date_string = ' امروز ';
            $date_string .= jdate( 'j F Y' , '' , '' , '' , '' );
            $date_string .= ' مصادف با ';
            $date_string .= '<div class="fix-date">';
            $date_string .= date('j F Y');
            $date_string .= '</div>';
        }
        $table_string = '<table class="prayer-table">';
        $table_string .= '<thead><tr><th class="c3">اوقات شرعی</th><th class="c4">زمان</th></tr></thead>';
        $table_string .= '<tbody id="prayer-today">';
        if(get_option('OghatAdminMenu')['show_d_fajr'])
        {
            $table_string .= '<tr><td class="c3">نماز صبح</td><td class="c4">'.$times['Fajr'].'</td></tr>';
        }
        if(get_option('OghatAdminMenu')['show_d_sunrise'])
        {
            $table_string .= '<tr><td class="c3">طلوع آفتاب</td><td class="c4">'.$times['Sunrise'].'</td></tr>';
        }
        if(get_option('OghatAdminMenu')['show_d_dhuhr'])
        {
            $table_string .= '<tr><td class="c3">نماز ظهر</td><td class="c4">'.$times['Dhuhr'].'</td></tr>';
        }
        if(get_option('OghatAdminMenu')['show_d_sunset'])
        {
            $table_string .= '<tr><td class="c3">غروب آفتاب</td><td class="c4">'.$times['Sunset'].'</td></tr>';
        }
        if(get_option('OghatAdminMenu')['show_d_maghrib'])
        {
            $table_string .= '<tr><td class="c3">نماز مغرب</td><td class="c4">'.$times['Maghrib'].'</td></tr>';
        }
        if(get_option('OghatAdminMenu')['show_d_midnight'])
        {
            $table_string .= '<tr><td class="c3">نیمه شب شرعی</td><td class="c4">'.$times['Midnight'].'</td></tr>';
        }
        $table_string .= '</tbody>';
        $table_string .= '</table>';
        $output = '<div class="prayer-time-wrap"><div class="prayer-time-date">'.$date_string.'</div><select id="locations-single">'.$locations_string.'</select><div>'.$table_string.'</div></div>';
        return $output;
    }
}
add_shortcode('show_today_prayer_times','show_today_prayer_times');