<?php
function oghat_settings_form($menu)
{
    $menu->addSettingFields(
        array(
            'field_id'      => 'date_type',
            'title'         => 'نمایش بر اساس : ',
            'type'          => 'radio',
            'label'         => array(
                'miladi' => 'تاریخ میلادی',
                'shamsi' => 'تاریخ شمسی',
            )
        ),
        array(
            'field_id'      => 'show_m_date',
            'type'          => 'checkbox',
            'title'         => 'نمایش تاریخ میلادی ماهانه',
        ),
        array(
            'field_id'      => 'show_m_jdate',
            'type'          => 'checkbox',
            'title'         => 'نمایش تاریخ شمسی ماهانه',
        ),
        array(
            'field_id'      => 'show_m_fajr',
            'type'          => 'checkbox',
            'title'         => 'نمایش اذان صبح ماهانه',
        ),
        array(
            'field_id'      => 'show_m_sunrise',
            'type'          => 'checkbox',
            'title'         => 'نمایش طلوع افتاب ماهانه',
        ),
        array(
            'field_id'      => 'show_m_dhuhr',
            'type'          => 'checkbox',
            'title'         => 'نمایش اذان ظهر ماهانه',
        ),
        array(
            'field_id'      => 'show_m_sunset',
            'type'          => 'checkbox',
            'title'         => 'نمایش غروب افتاب ماهانه',
        ),
        array(
            'field_id'      => 'show_m_maghrib',
            'type'          => 'checkbox',
            'title'         => 'نمایش اذان مغرب ماهانه',
        ),
        array(
            'field_id'      => 'show_m_midnight',
            'type'          => 'checkbox',
            'title'         => 'نمایش نیمه شب شرعی ماهانه',
        ),
        array(
            'field_id'      => 'show_d_date',
            'type'          => 'checkbox',
            'title'         => 'نمایش تاریخ میلادی روزانه',
        ),
        array(
            'field_id'      => 'show_d_jdate',
            'type'          => 'checkbox',
            'title'         => 'نمایش تاریخ شمسی روزانه',
        ),
        array(
            'field_id'      => 'show_d_fajr',
            'type'          => 'checkbox',
            'title'         => 'نمایش اذان صبح روزانه',
        ),
        array(
            'field_id'      => 'show_d_sunrise',
            'type'          => 'checkbox',
            'title'         => 'نمایش طلوع افتاب روزانه',
        ),
        array(
            'field_id'      => 'show_d_dhuhr',
            'type'          => 'checkbox',
            'title'         => 'نمایش اذان ظهر روزانه',
        ),
        array(
            'field_id'      => 'show_d_sunset',
            'type'          => 'checkbox',
            'title'         => 'نمایش غروب افتاب روزانه',
        ),
        array(
            'field_id'      => 'show_d_maghrib',
            'type'          => 'checkbox',
            'title'         => 'نمایش اذان مغرب روزانه',
        ),
        array(
            'field_id'      => 'show_d_midnight',
            'type'          => 'checkbox',
            'title'         => 'نمایش نیمه شب شرعی روزانه',
        ),
        array(
            'field_id'      => 'save',
            'type'          => 'submit',
            'value'         => 'ذخیره',
            'title'         => 'ذخیره تغییرات'
        )
    );
}
add_action('load_oghat_settings','oghat_settings_form');