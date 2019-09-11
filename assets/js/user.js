(function($) {
    $('#locations-single').on('change',function(){
        let name = $(this).val();
        $.post(ajax_object.ajax_url , {action : 'get_today_times',name : name},function(result){
            result = JSON.parse(result);
            let table_string = null;
            if(result.opt.show_d_fajr == '1')
            {
                table_string += '<tr><td class="c3">نماز صبح</td><td class="c4">'+result.Fajr+'</td></tr>';
            }
            if(result.opt.show_d_sunrise == '1')
            {
                table_string += '<tr><td class="c3">طلوع آفتاب</td><td class="c4">'+result.Sunrise+'</td></tr>';
            }
            if(result.opt.show_d_dhuhr == '1')
            {
                table_string += '<tr><td class="c3">نماز ظهر</td><td class="c4">'+result.Dhuhr+'</td></tr>';
            }
            if(result.opt.show_d_sunset == '1')
            {
                table_string += '<tr><td class="c3">غروب آفتاب</td><td class="c4">'+result.Sunset+'</td></tr>';
            }
            if(result.opt.show_d_maghrib == '1')
            {
                table_string += '<tr><td class="c3">نماز مغرب</td><td class="c4">'+result.Maghrib+'</td></tr>';
            }
            if(result.opt.show_d_midnight == '1')
            {
                table_string += '<tr><td class="c3">نیمه شب شرعی</td><td class="c4">'+result.Midnight+'</td></tr>';
            }
            $('#prayer-today').html(table_string);
        });
    });
    $('#locations-multiple').on('change',function(){
        let name = $(this).val();
        $.post(ajax_object.ajax_url , {action : 'get_this_month_times',name : name},function(result){
            result = JSON.parse(result);
            let table_string = null;
            console.log(result);
            let last = result.length - 1;
            for(let i = 0;i < (result.length - 1);i++)
            {
                if(result[i].today)
                {
                    table_string += '<tr>';
                    if(result[last].date_type == 'miladi')
                    {
                        if(result[last].show_m_date == '1')
                        {
                            table_string += '<td class="active"><div class="fix-date">'+result[i].date+'</div></td>';
                        }
                        if(result[last].show_m_jdate == '1')
                        {
                            table_string += '<td class="active">'+result[i].jdate+'</td>';
                        }
                    }
                    else
                    {
                        if(result[last].show_m_jdate == '1')
                        {
                            table_string += '<td class="active">'+result[i].jdate+'</td>';
                        }
                        if(result[last].show_m_date == '1')
                        {
                            table_string += '<td class="active"><div class="fix-date">'+result[i].date+'</div></td>';
                        }
                    }
                    if(result[last].show_m_fajr == '1')
                    {
                        table_string += '<td class="active">'+result[i].Fajr+'</td>';
                    }
                    if(result[last].show_m_sunrise == '1')
                    {
                        table_string += '<td class="active">'+result[i].Sunrise+'</td>';
                    }
                    if(result[last].show_m_dhuhr == '1')
                    {
                        table_string += '<td class="active">'+result[i].Dhuhr+'</td>';
                    }
                    if(result[last].show_m_sunset == '1')
                    {
                        table_string += '<td class="active">'+result[i].Sunset+'</td>';
                    }
                    if(result[last].show_m_maghrib == '1')
                    {
                        table_string += '<td class="active">'+result[i].Maghrib+'</td>';
                    }
                    if(result[last].show_m_midnight == '1')
                    {
                        table_string += '<td class="active">'+result[i].Midnight+'</td>';
                    }
                    table_string += '</tr>';
                }
                else
                {
                    table_string += '<tr>';
                    if(result[last].date_type == 'miladi')
                    {
                        if(result[last].show_m_date == '1')
                        {
                            table_string += '<td class="c2"><div class="fix-date">'+result[i].date+'</div></td>';
                        }
                        if(result[last].show_m_jdate == '1')
                        {
                            table_string += '<td class="c1">'+result[i].jdate+'</td>';
                        }
                    }
                    else
                    {
                        if(result[last].show_m_jdate == '1')
                        {
                            table_string += '<td class="c1">'+result[i].jdate+'</td>';
                        }
                        if(result[last].show_m_date == '1')
                        {
                            table_string += '<td class="c2"><div class="fix-date">'+result[i].date+'</div></td>';
                        }
                    } 
                    if(result[last].show_m_fajr == '1')
                    {
                        table_string += '<td class="c3">'+result[i].Fajr+'</td>';
                    }
                    if(result[last].show_m_sunrise == '1')
                    {
                        table_string += '<td class="c4">'+result[i].Sunrise+'</td>';
                    }
                    if(result[last].show_m_dhuhr == '1')
                    {
                        table_string += '<td class="c5">'+result[i].Dhuhr+'</td>';
                    }
                    if(result[last].show_m_sunset == '1')
                    {
                        table_string += '<td class="c6">'+result[i].Sunset+'</td>';
                    }
                    if(result[last].show_m_maghrib == '1')
                    {
                        table_string += '<td class="c7">'+result[i].Maghrib+'</td>';
                    }
                    if(result[last].show_m_midnight == '1')
                    {
                        table_string += '<td class="c8">'+result[i].Midnight+'</td>';
                    }
                    table_string += '</tr>';
                }
            }
            $('#prayer-month').html(table_string);
        });
    });
})( jQuery );