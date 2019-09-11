<?php
function show_this_month_prayer_times($args)
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
        $options = get_option('OghatAdminMenu');
        if(!function_exists('jdate'))
        {
            require_once(OGHAT_PLUGIN_DIR . '/libs/jdate/jdf.php');
        }
        $pt = new IslamicNetwork\PrayerTimes\PrayerTimes($method);
        $times = array();
        for($i = 1;$i<32;$i++)
        {
            if($options['date_type'] == 'miladi')
            {
                $mmonth = date('n');
                $myear = date('Y');
                if(checkdate($mmonth,$i,$myear))
                {
                    $date_string = $i.'/'.$mmonth.'/'.$myear;
                    $date = DateTime::createFromFormat('j/n/Y', $date_string ,new DateTimezone($location['time_zone']));
                    $timestamp = $date->getTimestamp();
                    $custom_date = jdate('Y-n-j',$timestamp,'','','en');    
                }
                else
                {
                    break;
                }
            }
            else
            {
                $jmonth = jdate('n');
                $jyear = jdate('Y');
                if(jcheckdate($jmonth,$i,$jyear))
                {
                    $gdate = jalali_to_gregorian($jyear,$jmonth,$i);
                    $date_string = $gdate[2].'/'.$gdate[1].'/'.$gdate[0];
                    $date = DateTime::createFromFormat('j/n/Y', $date_string ,new DateTimezone($location['time_zone']));
                    $custom_date = jdate('Y','','','','en').'-'.jdate('n','','','','en').'-'.$i;
                }
                else
                {
                    break;
                } 
            }
            if(isset($location['times'][$custom_date]))
            {
                $raw_items = $location['times'][$custom_date];
                $items = array('Fajr' => $raw_items['fajr'],'Sunrise' => $raw_items['sunrise'], 'Dhuhr' => $raw_items['dhuhr'],'Sunset' => $raw_items['sunset'],'Maghrib' => $raw_items['maghrib'], 'Midnight' => $raw_items['midnight']);
            }
            else
            {
                $items = $pt->getTimes($date,floatval($location['lat']), floatval($location['long']), null, IslamicNetwork\PrayerTimes\PrayerTimes::LATITUDE_ADJUSTMENT_METHOD_ANGLE, IslamicNetwork\PrayerTimes\PrayerTimes::MIDNIGHT_MODE_STANDARD, IslamicNetwork\PrayerTimes\PrayerTimes::TIME_FORMAT_24H);
            }
            $timestamp = $date->getTimestamp();
            $items['jdate'] = jdate('j F Y',$timestamp,'','','en');
            $items['date'] = date_format($date , 'j F Y');
            $items['today'] = false;
            if($items['date'] == date('j F Y'))
            {
                $items['today'] = true;
            }
            array_push($times,$items);
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
        $row_string = null;
        for($i = 0;$i<count($times);$i++)
        {
            if($times[$i]['today'])
            {
                $row_string .= '<tr>';
                if($options['date_type'] == 'miladi')
                {
                    if($options['show_m_date'])
                    {
                        $row_string .= '<td class="active"><div class="fix-date">'.$times[$i]['date'].'</div></td>';
                    }
                    if($options['show_m_jdate'])
                    {
                        $row_string .= '<td class="active">'.$times[$i]['jdate'].'</td>';
                    }
                }
                else
                {
                    if($options['show_m_jdate'])
                    {
                        $row_string .= '<td class="active">'.$times[$i]['jdate'].'</td>';
                    }
                    if($options['show_m_date'])
                    {
                        $row_string .= '<td class="active"><div class="fix-date">'.$times[$i]['date'].'</div></td>';
                    }

                }  
                if($options['show_m_fajr'])
                {
                    $row_string .= '<td class="active">'.$times[$i]['Fajr'].'</td>';
                }
                if($options['show_m_sunrise'])
                {
                    $row_string .= '<td class="active">'.$times[$i]['Sunrise'].'</td>';
                }
                if($options['show_m_dhuhr'])
                {
                    $row_string .= '<td class="active">'.$times[$i]['Dhuhr'].'</td>';
                }
                if($options['show_m_sunset'])
                {
                    $row_string .= '<td class="active">'.$times[$i]['Sunset'].'</td>';
                }
                if($options['show_m_maghrib'])
                {
                    $row_string .= '<td class="active">'.$times[$i]['Maghrib'].'</td>';
                }
                if($options['show_m_midnight'])
                {
                    $row_string .= '<td class="active">'.$times[$i]['Midnight'].'</td>';
                }
                $row_string .= '</tr>';
            }
            else
            {
                $row_string .= '<tr>';
                if($options['date_type'] == 'miladi')
                {
                    if($options['show_m_date'])
                    {
                        $row_string .= '<td class="c1"><div class="fix-date">'.$times[$i]['date'].'</div></td>';
                    }
                    if($options['show_m_jdate'])
                    {
                        $row_string .= '<td class="c2">'.$times[$i]['jdate'].'</td>';
                    }
                }
                else
                {
                    if($options['show_m_jdate'])
                    {
                        $row_string .= '<td class="c1">'.$times[$i]['jdate'].'</td>';
                    }
                    if($options['show_m_date'])
                    {
                        $row_string .= '<td class="c2"><div class="fix-date">'.$times[$i]['date'].'</div></td>';
                    }
                }
                if($options['show_m_fajr'])
                {
                    $row_string .= '<td class="c3">'.$times[$i]['Fajr'].'</td>';
                }
                if($options['show_m_sunrise'])
                {
                    $row_string .= '<td class="c4">'.$times[$i]['Sunrise'].'</td>';
                }
                if($options['show_m_dhuhr'])
                {
                    $row_string .= '<td class="c5">'.$times[$i]['Dhuhr'].'</td>';
                }
                if($options['show_m_sunset'])
                {
                    $row_string .= '<td class="c6">'.$times[$i]['Sunset'].'</td>';
                }
                if($options['show_m_maghrib'])
                {
                    $row_string .= '<td class="c7">'.$times[$i]['Maghrib'].'</td>';
                }
                if($options['show_m_midnight'])
                {
                    $row_string .= '<td class="c8">'.$times[$i]['Midnight'].'</td>';
                }
                $row_string .= '</tr>';        
            }
        }
        $table_string = '<table class="prayer-table">';
        $table_string .= '<thead><tr>';
        if($options['date_type'] == 'miladi')
        {
            if($options['show_m_date'])
            {
                $table_string .= '<th class="c2"><div class="fix-date">تاریخ میلادی</div></th>';
            }
            if($options['show_m_jdate'])
            {
                $table_string .= '<th class="c1">تاریخ شمسی</th>';
            }
        }
        else
        {
            if($options['show_m_jdate'])
            {
                $table_string .= '<th class="c1">تاریخ شمسی</th>';
            }
            if($options['show_m_date'])
            {
                $table_string .= '<th class="c2"><div class="fix-date">تاریخ میلادی</div></th>';
            }
        }
        if($options['show_m_fajr'])
        {
            $table_string .= '<th class="c3">اذان صبح</th>';
        }
        if($options['show_m_sunrise'])
        {
            $table_string .= '<th class="c4">طلوع آفتاب</th>';
        }
        if($options['show_m_dhuhr'])
        {
            $table_string .= '<th class="c5">اذان ظهر</th>';
        }
        if($options['show_m_sunset'])
        {
            $table_string .= '<th class="c6">غروب آفتاب</th>';
        }
        if($options['show_m_maghrib'])
        {
            $table_string .= '<th class="c7">اذان مغرب</th>';
        }
        if($options['show_m_midnight'])
        {
            $table_string .= '<th class="c8">نیمه شب شرعی</th>';
        }
        $row_string .= '</tr></thead>';
        $table_string .= '<tbody id="prayer-month">';
        $table_string .= $row_string;
        $table_string .= '</tbody>';
        $table_string .= '</table>';
        $output = '<div class="prayer-time-wrap"><select id="locations-multiple">'.$locations_string.'</select><div>'.$table_string.'</div></div>';
        return $output;
    }
}
add_shortcode('show_this_month_prayer_times','show_this_month_prayer_times');