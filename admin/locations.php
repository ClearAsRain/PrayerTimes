<?php
function oghat_manage_locations_form($menu)
{
    $zones = timezone_identifiers_list();
    $zone_array = array();
    foreach($zones as $zone)
    {
        $zone_array[$zone] = $zone;
    }
    $menu->addSettingFields(
        array(
            'field_id'      => 'location_name',
            'type'          => 'text',
            'title'         => 'نام منطقه',
        ),
        array(
            'field_id'      => 'location_time_zone',
            'type'          => 'select',
            'default'       => 'Asia/Tehran',
            'title'         => 'منطقه زمانی',
            'label'         => $zone_array
        ),
        array(
            'field_id'      => 'location_lat',
            'type'          => 'text',
            'title'         => 'عرض جغرافیایی',
        ),
        array(
            'field_id'      => 'location_long',
            'type'          => 'text',
            'title'         => 'طول جغرافیایی',
        ),
        array(
            'field_id'      => 'calc_method',
            'type'          => 'select',
            'title'         => 'متود محاسبه ی اوقات شرعی',
            'default'       => 'TEHRAN',
            'label'         => array(
                'TEHRAN'  => 'Institute of Geophysics, University of Tehran',
                'MWL' => 'Muslim World League',
                'ISNA' => 'Islamic Society of North America (ISNA)',
                'EGYPT' => 'Egyptian General Authority of Survey',
                'KARACHI' => 'University of Islamic Sciences, Karachi',
                'MAKKAH' => 'Umm al-Qura University, Makkah',
                'JAFARI' => 'Shia Ithna Ashari, Leva Research Institute, Qum'
            )
        )
    );
}
add_action('load_oghat_manage_locations','oghat_manage_locations_form');
function oghat_manage_locations_content($content)
{
    $desc = '<br><p>در صورتی که نام منطقه را تکراری وارد نمایید منطقه ی مورد نظر آپدیت خواهد شد</p>';
    $add_button = '<br><div id="add-location" class="button button-primary">ذخیره کردن</div>';
    $location_title = '<br><h3>لیست مناطق</h3>';
    $locations = get_option('oghat_locations');
    $location_string = null;
    if($locations != false && is_array($locations))
    {
        foreach($locations as $key=>$location)
        {
            $location_string .= '<div class="location"><div class="location-name">نام : '.$location["name"].'</div><div class="location-long">طول : '.$location["long"].'</div><div class="location-lat">عرض : '.$location["lat"].'</div><div class="location-zone">منطقه زمانی : '.$location["time_zone"].'</div><div class="location-method">متود محاسبه : '.$location["method"].'</div><div data-uniq-id="'.$key.'" class="location-delete">حذف</div></div>';
        }
    }
    $location_wrap = '<br><div id="location-wrap">'.$location_string.'</div>';
    $content .= $desc.$add_button.$location_title.$location_wrap;
    return $content;
}
add_action('content_oghat_manage_locations','oghat_manage_locations_content');