<?php
function add_oghat_location()
{
    $long = $_POST["long"];
    $lat = $_POST["lat"];
    $time_zone = $_POST["time_zone"];
    $name = $_POST["name"];
    $method = $_POST["method"];
    $list = get_option('oghat_locations');
    $reuired_check = true;
    $required = array('long','lat','name');
    foreach($required as $req)
    {
        if(!isset($_POST[$req]) || empty($_POST[$req]))
        {
            $reuired_check = false;
            break;
        }
    }
    if(!$reuired_check)
    {
        $result = array('success' => false,'msg' => 'همه ی فیلد ها الزامی است');
        $result = wp_json_encode($result);
        wp_send_json($result);
        wp_die();
    }
    if(!is_numeric($lat) || !is_numeric($long))
    {
        $result = array('success' => false,'msg' => 'طول و عرض جغرافیایی باید عدد باشند');
        $result = wp_json_encode($result);
        wp_send_json($result);
        wp_die();
    }
    $new = true;
    if($list == false)
    {
        $list = array();
    }
    else
    {
        if(isset($list[$name]))
        {
            $new = false;
        }
    }
    $list[$name]['name'] = $name;
    $list[$name]['long'] = $long;
    $list[$name]['lat'] = $lat;
    $list[$name]['time_zone'] = $time_zone; 
    $list[$name]['method'] = $method;
    $check = update_option('oghat_locations',$list);
    if($check == false)
    {
        $success = false;
    }
    else
    {
        $success = true;
    }
    if($new)
    {
        $msg = 'منطقه مورد نظر با موفقیت  اضافه شد';
    }
    else
    {
        $msg = 'منطقه مورد نظر با موفقیت  آپدیت شد';
    }
    $result = array('success' => $success,'name' => $name,'long' => $long,'lat'=> $lat,'time_zone'=> $time_zone,'method'=>$method,'new' => $new,'msg' => $msg);
    $result = wp_json_encode($result);
    wp_send_json($result);
    wp_die();
}
add_action( 'wp_ajax_add_oghat_location', 'add_oghat_location' );
function remove_oghat_location()
{
    $name = $_POST['name'];
    $list = get_option('oghat_locations');
    unset($list[$name]);
    update_option('oghat_locations',$list);
}
add_action( 'wp_ajax_remove_oghat_location', 'remove_oghat_location' );
function add_oghat_time()
{
    if(!function_exists('jdate'))
    {
        require_once(OGHAT_PLUGIN_DIR . '/libs/jdate/jdf.php');
    }
    $locations = get_option('oghat_locations');
    $year = $_POST['year'];
    $month = $_POST['month']*1;
    $day = $_POST['day']*1;
    $location = $_POST['location'];
    $fajr = $_POST['fajr'];
    $sunrise = $_POST['sunrise'];
    $dhuhr = $_POST['dhuhr'];
    $sunset = $_POST['sunset'];
    $maghrib = $_POST['maghrib'];
    $midnight = $_POST['midnight'];
    $reuired_check = true;
    $required = array('year','month','day','location','fajr','sunrise','dhuhr','sunset','maghrib','midnight');
    foreach($required as $req)
    {
        if(!isset($_POST[$req]) || empty($_POST[$req]))
        {
            $reuired_check = false;
            break;
        }
    }
    if(!$reuired_check)
    {
        $result = array('success' => false,'msg' => 'همه ی فیلد ها الزامی است');
        $result = wp_json_encode($result);
        wp_send_json($result);
        wp_die();
    }
    if(!is_numeric($year) || !is_numeric($month) || !is_numeric($day))
    {
        $result = array('success' => false,'msg' => 'ماه و سال و روز باید عدد باشند');
        $result = wp_json_encode($result);
        wp_send_json($result);
        wp_die();
    }
    $date = $year.'-'.$month.'-'.$day;
    if($year > 2000)
    {
        if(!function_exists('jdate'))
        {
            require_once(OGHAT_PLUGIN_DIR . '/libs/jdate/jdf.php');
        }
        $format = 'Y-n-j';
        $date = DateTime::createFromFormat($format, $date);
        $timestamp = $date->getTimestamp();
        $date = jdate('Y-n-j',$timestamp,'','','en');
        $date_explode = explode('-',$date);
        $year = $date_explode[0];
        $month = $date_explode[1];
        $day = $date_explode[2];
    }
    $insert_array = array('year' => $year,'month' => $month,'day' => $day,'fajr' => $fajr,'sunrise' => $sunrise,'dhuhr' => $dhuhr,'sunset' => $sunset,'maghrib' => $maghrib,'midnight' => $midnight);
    $new = true;
    $success = false;
    $msg = 'متاسفانه مشکلی پیش آمد لطفا یک بار دیگر تلاش کنید';
    if(!isset($locations[$location]['times']))
    {
        $locations[$location]['times'] = array();
    }
    if($locations[$location]['times'][$date])
    {
        $new = false;
    }
    $locations[$location]['times'][$date] = $insert_array;
    $check = update_option('oghat_locations',$locations);
    if($check)
    {
        $success = true;
    }
    if($new)
    {
        $msg = 'زمان های مورد نظر با موفقیت اضافه شدند';
    }
    else
    {
        $msg = 'زمان های مورد نظر با موفقیت آپدیت شدند';
    }
    $mdate = explode('-',$date);
    $gdate = jalali_to_gregorian($mdate[0],$mdate[1],$mdate[2]);
    $result = array('success' => $success,'new' => $new,'year' => $year,'month' => $month,'day' => $day,'gyear' => $gdate[0],'gmonth' => $gdate[1],'gday' => $gdate[2],'fajr' => $fajr,'sunrise' => $sunrise,'dhuhr' => $dhuhr,'sunset' => $sunset,'maghrib' => $maghrib,'midnight' => $midnight,'date' => $date , 'name' => $location , 'msg' => $msg);
    $result = wp_json_encode($result);
    wp_send_json($result);
    wp_die();
}
add_action('wp_ajax_add_oghat_time','add_oghat_time');
function remove_oghat_time()
{
    $location = $_POST['location'];
    $date = $_POST['date'];
    $list = get_option('oghat_locations');
    unset($list[$location]['times'][$date]);
    update_option('oghat_locations',$list);
}
add_action('wp_ajax_remove_oghat_time','remove_oghat_time');
function get_today_times()
{
    $name = $_POST['name'];
    $locations = get_option('oghat_locations');
    $location = $locations[$name];
    $method = $location['method'];
    require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/DMath.php');
    require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/Method.php');
    require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/PrayerTimes.php');
    $pt = new IslamicNetwork\PrayerTimes\PrayerTimes($method);
    if(!function_exists('jdate'))
    {
        require_once(OGHAT_PLUGIN_DIR . '/libs/jdate/jdf.php');
    }
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
    $times['opt'] = get_option('OghatAdminMenu');
    $result = wp_json_encode($times);
    wp_send_json($result);
    wp_die();
}
add_action( 'wp_ajax_get_today_times', 'get_today_times' );
add_action( 'wp_ajax_nopriv_get_today_times', 'get_today_times' );
function get_this_month_times()
{
    $name = $_POST['name'];
    $locations = get_option('oghat_locations'); 
    $location = $locations[$name];
    $method = $location['method'];
    $options = get_option('OghatAdminMenu');
    require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/DMath.php');
    require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/Method.php');
    require_once(OGHAT_PLUGIN_DIR . '/libs/prayer-times/PrayerTimes.php');
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
    array_push($times,$options);
    $result = wp_json_encode($times);
    wp_send_json($result);
    wp_die();
}
add_action( 'wp_ajax_get_this_month_times', 'get_this_month_times' );
add_action( 'wp_ajax_nopriv_get_this_month_times', 'get_this_month_times' );