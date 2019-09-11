<?php
function oghat_manage_times_form($menu)
{
    $locations = get_option('oghat_locations');
    $location_list = array();
    if($locations != false)
    {
        foreach($locations as $key => $value)
        {
            $location_list[$key] = $key;
        }
    }  
    $menu->addSettingFields(
        array(
            'field_id'      => 'year',
            'type'          => 'text',
            'title'         => 'سال'
        ),
        array(
            'field_id'      => 'month',
            'type'          => 'text',
            'title'         => 'ماه'
        ),
        array(
            'field_id'      => 'day',
            'type'          => 'text',
            'title'         => 'روز'
        ),
        array(
            'field_id'      => 'locations',
            'type'          => 'select',
            'title'         => 'منطقه',
            'label'         => $location_list
        ),
        array(
            'field_id'      => 'fajr',
            'type'          => 'text',
            'title'         => 'نماز صبح'
        ),
        array(
            'field_id'      => 'sunrise',
            'type'          => 'text',
            'title'         => 'طلوع آفتاب'
        ),
        array(
            'field_id'      => 'dhuhr',
            'type'          => 'text',
            'title'         => 'نماز ظهر'
        ),
        array(
            'field_id'      => 'sunset',
            'type'          => 'text',
            'title'         => 'غروب آفتاب'
        ),
        array(
            'field_id'      => 'maghrib',
            'type'          => 'text',
            'title'         => 'نماز مغرب'
        ),
        array(
            'field_id'      => 'midnight',
            'type'          => 'text',
            'title'         => 'نیمه شب شرعی'
        )
    );
}
add_action('load_oghat_manage_times','oghat_manage_times_form');
function oghat_manage_times_content($content)
{
    if(!function_exists('jdate'))
    {
        require_once(OGHAT_PLUGIN_DIR . '/libs/jdate/jdf.php');
    }
    $locations = get_option('oghat_locations');
    if($locations != false)
    {
        $desc = '<br><p>در صورتی که نام منطقه و تاریخ را تکراری وارد نمایید زمان های مورد نظر آپدیت خواهند شد</p>';
        $add_button = '<br><div id="add-time" class="button button-primary">ذخیره کردن</div>';
        $location_wrap_string = '';
        foreach($locations as $key=>$value)
        {   
            $location_wrap_string .= '<div class="location-container"><div class="location-header">'.$key.'<div class="location-header-icon close"></div></div><div class="location-content"><table data-uniqe-id="'.$key.'"><tr><th>سال شمسی</th><th>ماه شمسی</th><th>روز شمسی</th><th>سال میلادی</th><th>ماه میلادی</th><th>روز میلادی</th><th>اذان صبح</th><th>طلوع آفتاب</th><th>اذان ظهر</th><th>غروب آفتاب</th><th>اذان مغرب</th><th>نیمه شب شرعی</th><th>حذف</th></tr>';
            if(isset($value['times']))
            {
                foreach ($value['times'] as $date => $time)
                {
                    $mdate = explode('-',$date);
                    $gdate = jalali_to_gregorian($mdate[0],$mdate[1],$mdate[2]);
                    $location_wrap_string .= '<tr data-uniqe-id="'.$date.'"><td>'.$time['year'].'</td><td>'.$time['month'].'</td><td>'.$time['day'].'</td><td>'.$gdate[0].'</td><td>'.$gdate[1].'</td><td>'.$gdate[2].'</td><td>'.$time['fajr'].'</td><td>'.$time['sunrise'].'</td><td>'.$time['dhuhr'].'</td><td>'.$time['sunset'].'</td><td>'.$time['maghrib'].'</td><td>'.$time['midnight'].'</td><td><div data-uniqe-id="'.$date.'" data-location="'.$key.'" class="delete-time">حذف</div></td></tr>';
                }
            }
            $location_wrap_string .= '</table></div></div>';
        }
        $content .= $desc.$add_button.$location_wrap_string;
    }
    return $content;
}
add_action('content_oghat_manage_times','oghat_manage_times_content');
