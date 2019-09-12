(function($) {
    $('#add-location').on('click',function(){
        Swal.fire({
            title: 'در حال پردازش',
        });
        Swal.showLoading();
        let name = $('#location_name__0').val();
        let long = $('#location_long__0').val();
        let lat = $('#location_lat__0').val();
        let time_zone = $('#location_time_zone__0').val();
        let method = $('#calc_method__0').val();
        $.post(ajaxurl,{action : 'add_oghat_location',name : name,long : long, lat : lat,time_zone : time_zone , method : method},function(result,success){
            result = JSON.parse(result);
            if(result.success == true)
            {
                if(result.new == true)
                {
                    $('#location-wrap').append('<div class="location"><div class="location-name">نام : '+result.name+'</div><div class="location-long">طول : '+result.long+'</div><div class="location-lat">عرض : '+result.lat+'</div><div class="location-zone">منطقه زمانی : '+result.time_zone+'</div><div class="location-method">متود محاسبه : '+result.method+'</div><div data-uniq-id="'+result.name+'" class="location-delete">حذف</div></div>');
                    Swal.fire({
                        type: 'success',
                        text: result.msg,
                        confirmButtonText: 'باشه !',
                    })
                }
                else
                {
                    $('div[data-uniq-id='+result.name+']').parent().html('<div class="location-name">نام : '+result.name+'</div><div class="location-long">طول : '+result.long+'</div><div class="location-lat">عرض : '+result.lat+'</div><div class="location-zone">منطقه زمانی : '+result.time_zone+'</div><div class="location-method">متود محاسبه : '+result.method+'</div><div data-uniq-id="'+result.name+'" class="location-delete">حذف</div>');
                    Swal.fire({
                        type: 'success',
                        text: result.msg,
                        confirmButtonText: 'باشه !',
                    })
                } 
            }
            else
            {
                Swal.fire({
                    type: 'error',
                    text: result.msg,
                    confirmButtonText: 'باشه !',
                  })
            }
        });
    });
    $('#location-wrap').on('click','.location-delete',function(){
        Swal.fire({
            text: "آیا از حذف این منطقه اطمینان دارید؟",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر'
            }).then((result) => {
            if (result.value) {
                let name = $(this).data('uniq-id');
                $.post(ajaxurl,{action : 'remove_oghat_location',name : name});
                $(this).parent().remove();
                Swal.fire(
                {
                    type: 'success',
                    text: 'منطقه مورد نظر با موفقیت حذف شد',
                    confirmButtonText: 'باشه !',
                }
              )
            }
          })
    });
    $('#add-time').on('click',function(){
        Swal.fire({
            title: 'در حال پردازش',
        });
        Swal.showLoading();
        let year = $('#year__0').val();
        let month = $('#month__0').val();
        let day = $('#day__0').val();
        let location = $('#locations__0').val();
        let fajr = $('#fajr__0').val();
        let sunrise = $('#sunrise__0').val();
        let dhuhr = $('#dhuhr__0').val();
        let sunset = $('#sunset__0').val();
        let maghrib = $('#maghrib__0').val();
        let midnight = $('#midnight__0').val();
        $.post(ajaxurl , {action : 'add_oghat_time',year :year,month :month,day :day,location :location,fajr :fajr,sunrise :sunrise,dhuhr :dhuhr,sunset :sunset,maghrib :maghrib,midnight :midnight},function(result){
            result = JSON.parse(result);
            if(result.success == true)
            {
                if(result.new == true)
                {
                    $('table[data-uniqe-id="'+result.name+'"]').append('<tr data-uniqe-id="'+result.date+'"><td>'+result.year+'</td><td>'+result.month+'</td><td>'+result.day+'</td><td>'+result.gyear+'</td><td>'+result.gmonth+'</td><td>'+result.gday+'</td><td>'+result.fajr+'</td><td>'+result.sunrise+'</td><td>'+result.dhuhr+'</td><td>'+result.sunset+'</td><td>'+result.maghrib+'</td><td>'+result.midnight+'</td><td><div data-uniqe-id="'+result.date+'" data-location="'+result.name+'" class="delete-time">حذف</div></td></tr>');
                    Swal.fire({
                        type: 'success',
                        text: result.msg,
                        confirmButtonText: 'باشه !',
                    })
                }
                else
                {
                    $('tr[data-uniqe-id="'+result.date+'"]').html('<td>'+result.year+'</td><td>'+result.month+'</td><td>'+result.day+'</td><td>'+result.gyear+'</td><td>'+result.gmonth+'</td><td>'+result.gday+'</td><td>'+result.fajr+'</td><td>'+result.sunrise+'</td><td>'+result.dhuhr+'</td><td>'+result.sunset+'</td><td>'+result.maghrib+'</td><td>'+result.midnight+'</td><td><div data-uniqe-id="'+result.date+'" data-location="'+result.name+'" class="delete-time">حذف</div></td>');
                    Swal.fire({
                        type: 'success',
                        text: result.msg,
                        confirmButtonText: 'باشه !',
                    })
                } 
            }
            else
            {
                Swal.fire({
                    type: 'error',
                    text: result.msg,
                    confirmButtonText: 'باشه !',
                  })
            }
        });
    });
    $('.location-content table').on('click','tr td .delete-time',function(){
        Swal.fire({
            text: "آیا از حذف این زمان ها اطمینان دارید؟",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'بله',
            cancelButtonText: 'خیر'
            }).then((result) => {
            if (result.value) {
                let location = $(this).data('location');
                let date = $(this).data('uniqe-id');
                $.post(ajaxurl,{action : 'remove_oghat_time',location : location,date : date});
                $(this).parent().parent().remove();
                Swal.fire(
                {
                    type: 'success',
                    text: 'زمان های مورد نظر با موفقیت حذف شدند',
                    confirmButtonText: 'باشه !',
                }
              )
            }
          })
    });
    $('.location-header').on('click',function(){
        $(this).next().toggle();
        $(this).find('.location-header-icon').toggleClass('open');
        $(this).find('.location-header-icon').toggleClass('close');
    });
})( jQuery );