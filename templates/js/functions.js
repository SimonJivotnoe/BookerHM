function buildHead( day )
{
    var headData = '<tr>';
    var nameDayOfWeek = [ 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday' ];
    if ( day == 'Monday begin' )
    {
        for ( var i = 0; i <= 6; i ++ )
        {
            headData += '<th>' + nameDayOfWeek[ i ] + '</th>';
        }
        headData += '</tr>';
        return headData;
    } else
    {
        nameDayOfWeek.splice( 0, 0, nameDayOfWeek.splice( - 1, 5 )[ 0 ] );
        for ( i = 0; i <= 6; i ++ )
        {
            headData += '<th>' + nameDayOfWeek[ i ] + '</th>';
        }
        headData += '</tr>';
        return headData;
    }

}

function lScomm()
{
    var objLS = JSON.parse( localStorage[ 'settings' ] );
    return objLS[ 0 ][ 'start day of week' ];
}

function getLSTimeFormat(){
    var objLS = JSON.parse( localStorage[ 'settings' ] );
    return objLS[ 0 ][ 'timeFormat' ];
}

function setLS() {
    var room = $('.rooms').val();
    localStorage[ 'settings' ] =
        JSON.stringify( [ { "start day of week": 'Monday begin', "timeFormat": '24 Hours', "room": room } ] );
    $( '#weekBegin' ).text( 'Sunday begin' );
    $( '#timeFormat' ).text( 'AM / PM' );
}

function lSbuttonChanger(paramKey, paramVal1, paramVal2, buttonName){
    var objLS = JSON.parse( localStorage[ 'settings' ] );
    if (paramVal1 == objLS[ 0 ][ paramKey ]) {
        $( buttonName ).text( paramVal2 );
    } else if(paramVal2 == objLS[ 0 ][ paramKey ]){
        $( buttonName ).text( paramVal1 );
    } else {
        setLS();
    }
}

function lSchanger( paramKey, paramVal )
{
    var objLS = JSON.parse( localStorage[ 'settings' ] );
    $.each( objLS, function ( key, val )
    {
        val[paramKey] = paramVal;
    } );
    localStorage[ 'settings' ] = JSON.stringify(objLS);
}

function twoDigitsInMinutes(minutes) {
    var result = ( minutes.getMinutes()<10?'0':'') + minutes.getMinutes();
    return result;
}

function timeFormatter(hours){
    var objLS = JSON.parse( localStorage[ 'settings' ] );
    if ('24 Hours' == getLSTimeFormat()) {
        var res = hours.getHours() + ':' + twoDigitsInMinutes(hours);
        return res;
    } else {
        if (hours.getHours() > 12){
            var hour = parseInt(hours.getHours()) - 12;
            var amPm = "PM";
        } else if(hours.getHours() == 12){
            var hour = 12;
            var amPm = "PM";
        } else if(hours.getHours() == 0) {
            var hour = 12;
            var amPm = "AM";
        } else {
            var hour = hours.getHours();
            var amPm = "AM";
        }
        var time = hour + ":" + twoDigitsInMinutes(hours) + " " + amPm;
        return time;
    }

}

function lSgetRoom(){
    var objLS = JSON.parse( localStorage[ 'settings' ] );
    return parseInt(objLS[ 0 ][ 'room' ]);
}

function selectedRoom(){
    var room_id = lSgetRoom();
    $(".rooms option[value="+room_id+"]" ).prop('selected', true);
}

var months = [ 'January', 'February', 'March', 'April', 'May', 'June',
    'July', 'August', 'September', 'October', 'November', 'December' ];
function GetMonthName( monthNumber )
{

    return months[ monthNumber ];
}

function generateDaysList( month, lastDayOfMonth, dayStart, year )
{
    for ( var i = 1; i <= lastDayOfMonth; i ++ )
    {
        if ( i < dayStart )
        {
            $( '.bookItDate' ).append( '<option disabled value="' + i + '">' + i + '</option>' );
        } else if ( i == dayStart )
        {
            if ( weekEnds( new Date( year, month, i ) ) )
            {
                $( '.bookItDate' ).append( '<option selected value=" ' + i + '" class="activeDay">' + i + '</option>' );
            } else
            {
                $( '.bookItDate' ).append( '<option disabled value="' + i + '">' + i + '</option>' );
            }

        } else
        {
            if ( weekEnds( new Date( year, month, i ) ) )
            {
                $( '.bookItDate' ).append( '<option value="' + i + '" class="activeDay">' + i + '</option>' );
            } else
            {
                $( '.bookItDate' ).append( '<option disabled value="' + i + '">' + i + '</option>' );
            }

        }
    }

}
function fillDateSelect( month, lastDayOfMonth, dayStart, year )
{
    for ( i = 0; i <= 11; i ++ )
    {
        if ( i == month )
        {
            $( '.bookItMonth' ).append( '<option selected="selected" value="' + i + '">' + months[ i ] + '</option>' );
        } else
        {
            $( '.bookItMonth' ).append( '<option value="' + i + '">' + months[ i ] + '</option>' );
        }

    }
    generateDaysList( month, lastDayOfMonth, dayStart, year );

    for ( var i = 0; i <= 11; i ++ )
    {
        var count = new Date().getFullYear() + i;
        if ( count == year )
        {
            $( '.bookItYear' ).append( '<option selected="selected" value="' + count + '">' + count + '</option>' );
        } else
        {
            $( '.bookItYear' ).append( '<option value="' + count + '">' + count + '</option>' );
        }
    }
}

function weekEnds( date )
{
    if ( date.getDay() == 0 || date.getDay() == 6 )
    {
        return false;
    } else
    {
        return true;
    }
}

function getListOfDays( curYear, curMonth )
{
    $( '.bookItDate, .startHour, .endHour' ).html( '' );
    var curDate = new Date( new Date().setHours( 0, 0, 0, 0 ) );
    var daysInMonth = 32 - new Date( curYear, curMonth, 32 ).getDate();
    if ( curDate.getFullYear() == curYear )
    {
        if ( curDate.getMonth() == curMonth )
        {
            generateDaysList( curMonth, daysInMonth, new Date().getDate(), curYear );
        } else if ( curDate.getMonth() > curMonth )
        {
            generateDaysList( curMonth, daysInMonth, 32, curYear );
        } else
        {
            generateDaysList( curMonth, daysInMonth, 1, curYear );
        }
    } else if ( curDate.getFullYear() > curYear )
    {
        generateDaysList( curMonth, daysInMonth, 32, curYear );
    } else
    {
        generateDaysList( curMonth, daysInMonth, 1, curYear );
    }
}

function fillHoursAndMinutes( timeFormat, date)
{
    $( '.startHour, .endHour' ).html( '' );
    var nowHour = new Date().getHours();
    var nowMinutes = new Date().getMinutes();
    var start = 0;
    var end = 23;
    var startTF = '';
    var endTF = '';
    if ( 'am' == timeFormat )
    {
        end = 11;
        startTF = $('.startTimeFormat select' ).val();
        endTF = $('.endTimeFormat select' ).val();
    }
    if (23 == end) {
        if ( date.setHours( 0, 0, 0, 0 ) == new Date().setHours( 0, 0, 0, 0 ) )
        {
            for ( i = start; i <= end; i ++ )
            {
                if ( nowHour == i )
                {
                    if (nowMinutes >= 30) {
                        hoursDisable(i);
                    } else {
                        hoursSelected(i);
                    }
                } else if ( nowHour > i )
                {
                    hoursDisable(i);
                } else
                {
                    hoursActiveDay(i);
                }
            }
        } else if ( date.getTime() > new Date().getTime() )
        {
            for ( i = start; i <= end; i ++ )
            {
                hoursActiveDay(i);
            }
        } else
        {
            for ( var i = start; i <= end; i ++ )
            {
                hoursDisable(i);
            }
        }
    } else {
        if ( date.setHours( 0, 0, 0, 0 ) == new Date().setHours( 0, 0, 0, 0 ) )
        {
            for ( i = start; i <= end; i ++ )
            {
                hoursBuildNowAMPM(nowHour, i, nowMinutes, startTF, '.startHour');
                hoursBuildNowAMPM(nowHour, i, nowMinutes, endTF, '.endHour');
            }
        } else if ( date.getTime() > new Date().getTime() )
        {
            for ( i = start; i <= end; i ++ )
            {
                hoursActiveDayAMPM(i, '.startHour');
                hoursActiveDayAMPM(i, '.endHour');
            }
        } else
        {
            for ( var i = start; i <= end; i ++ )
            {
                hoursDisableAMPM(i, '.startHour');
                hoursDisableAMPM(i, '.endHour');
            }
        }
    $( ".startHour option[value='0']").text(12);
    $( ".endHour option[value='0']").text(12);
    }
}

function getTimeFormat()
{
    if ('24 Hours' == getLSTimeFormat()) {
        return 24;
    } else if('AM / PM' == getLSTimeFormat()){
        return 'am';
    } else {
        return 24;
    }

}

function confirmDelete()
{
    return confirm( 'Are You sure want to delete this user and all his appointments ?' );
}

function formatEncode(hour, position) {
    if ('24 Hours' == getLSTimeFormat()) {
        return hour;
    } else {
        if ('AM' == $(position + ' select').val()) {
            return hour;
        } else {
            return hour + 12;
        }
    }
}

function validation( year, month, day, insert, recType, duration )
{
    year = parseInt( year );//console.log(year);
    month = parseInt( month );//console.log(month);
    day = parseInt( day );//console.log(day);
   // var startHour = parseInt($('.startHour' ).val());//console.log(startHour);
    var startHour = formatEncode(parseInt($('.startHour option:selected' ).val()), '.startTimeFormat');
    var startMinutes = parseInt($('.startMin option:selected' ).val());//console.log(startMinutes);
    //var endHour = parseInt($('.endHour' ).val());//console.log(endHour);
    var endHour = formatEncode(parseInt($('.endHour' ).val()), '.endTimeFormat');
    var endMinutes = parseInt($('.endMin' ).val());//console.log(endMinutes);
    var appStart = new Date(year, month, day, startHour, startMinutes ).getTime();//console.log(appStart);
    var appEnd = new Date(year, month, day, endHour, endMinutes ).getTime();//console.log(appEnd);
    var dayStart = new Date(year, month, day ).getTime(); //console.log(dayStart);
    var dayEnd = new Date(year, month, day, 23, 59).getTime(); //console.log(dayEnd);
    var room_id = lSgetRoom();
    if (insert == 'insert') {
        insertApp('index.php?page=AjaxTime', appStart, appEnd, dayStart, dayEnd, room_id);
    } else {
        if ( new Date(year, month, day) >= new Date().setHours( 0, 0, 0, 0 )){
            $('.checkDate' ).html('<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>');
            if (appEnd > appStart) {
                checkTime(appStart, appEnd, dayStart, dayEnd, recType, duration, room_id);
            } else {
                $('.checkTime' ).html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>');
                $('.newBookItButton' ).attr('disabled', 'disabled');
            }
        }else {
            $('.checkDate' ).html('<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>');
            $('.newBookItButton' ).attr('disabled', 'disabled');
        }
    }
}

function checkUpdate(curStartHour, curEndHour){
    console.log(curStartHour);
    console.log(curEndHour);
    if (curStartHour >= curEndHour) {
        $('.update' ).prop('disabled', true);
    } else {
        $('.update' ).prop('disabled', false);
    }
}