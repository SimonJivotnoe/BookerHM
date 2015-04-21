$( document ).ready( function ()
{
    var startH = new Date(parseInt($('.startHour' ).text())).getHours();
    var endH = new Date(parseInt($('.endHour' ).text())).getHours();
    var startM = new Date(parseInt($('.startHour' ).text())).getMinutes();
    var endM = new Date(parseInt($('.endHour' ).text())).getMinutes();
    var year = new Date(parseInt($('.startHour' ).text())).getFullYear();
    var month = new Date(parseInt($('.startHour' ).text())).getMonth();
    var day = new Date(parseInt($('.startHour' ).text())).getDate();
    var todayStartInMS = new Date(year, month, day).getTime();
    var todayEndInMS = new Date(year, month, day, 23, 59, 59).getTime();
    var curStartHour;
    var curEndHour;
    $('.startHour,.endHour, .startTimeFormat, .endTimeFormat' ).html('');
    if ('AM / PM' == getLSTimeFormat()) {
        $('.startTimeFormat, .endTimeFormat' ).append(
            '<select><option>AM</option><option>PM</option></select>'
        );
    } else {
        for (var i = 0; i <= 23; i ++) {
            if (startH == i) {
                $('.startHour' ).append('<option selected>' + i + '</option>');
            } else {
                $('.startHour' ).append('<option>' + i + '</option>');
            }
        }
        if (0 == startM) {
            $( ".startMin option[value='0']").attr('selected', 'selected');
        } else {
            $( ".startMin option[value='30']").attr('selected', 'selected');
        }

        for (var i = 0; i <= 23; i ++) {
            if (endH == i) {
                $('.endHour' ).append('<option selected>' + i + '</option>');
            } else {
                $('.endHour' ).append('<option>' + i + '</option>');
            }
        }
        if (0 == endM) {
            $( ".endMin option[value='0']").attr('selected', 'selected');
        } else {
            $( ".endMin option[value='30']").attr('selected', 'selected');
        }
    }

    $('.startHour').on('change', function(){
        var curStartHour = parseInt($('.startHour option:selected' ).val());
        var curEndHour = parseInt($('.endHour option:selected' ).val());
        console.log(curStartHour );
        checkUpdate(curStartHour, curEndHour);
    })
    $('.endHour').on('change', function(){
        var curStartHour = parseInt($('.startHour option:selected' ).val());
        var curEndHour = parseInt($('.endHour option:selected' ).val());
        console.log(curEndHour );
        checkUpdate(curStartHour, curEndHour);
    })
    $('.delete').on('click', function(){
    var app_id = $(this ).attr('name');
        deleteAppointment('index.php?page=EditUpdateCtrl', app_id);
    })

    $('.update').on('click', function(){
        var app_id = $(this ).attr('name');
        var room_id = lSgetRoom()
        updateAppointment('index.php?page=EditUpdateCtrl&action=update&app_id=',
            app_id, todayStartInMS, todayEndInMS, room_id);
    })
})
