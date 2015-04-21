function hoursDisable(i) {
    $( '.startHour, .endHour' ).append( '<option disabled value="' + i + '">' + i + '</option>' );
}
function hoursSelected(i) {
    $( '.startHour, .endHour' ).append( '<option class="activeDay" selected="selected" value="' +
    i + '">' + i + '</option>' );
}
function hoursActiveDay(i){
    $( '.startHour, .endHour' ).append( '<option class="activeDay" value="' + i + '">' + i + '</option>' );
}

function hoursDisableAMPM(i, position) {
    $( position ).append( '<option disabled value="' + i  + '">' + i + '</option>' );
}

function hoursSelectedAMPM(i, position) {
    $( position ).append( '<option class="activeDay" selected="selected" value="' +
    i  + '">' + i + '</option>' );
}

function hoursActiveDayAMPM(i, position){
    $( position ).append( '<option class="activeDay" value="' + i + '">' + i + '</option>' );
}

function hoursBuildNowAMPM(nowHour, i, nowMinutes, positionTF, position){
   if ('AM' == positionTF) {
       if ( nowHour == (i + 1) )
       {
           if (nowMinutes >= 30) {
               hoursDisableAMPM(i, position);
           } else {
               hoursSelectedAMPM(i, position);
           }
       } else if ( nowHour > (i + 1) )
       {
           hoursDisableAMPM(i, position);
       } else
       {
           hoursActiveDayAMPM(i, position);
       }
   } else {
       if ( nowHour == (i + 13) )
       {
           if (nowMinutes >= 30) {

               hoursDisableAMPM(i, position);
           } else {
               hoursSelectedAMPM(i, position);
           }
       } else if ( nowHour > (i + 13) )
       {
           hoursDisableAMPM(i, position);
       } else
       {
           hoursActiveDayAMPM(i, position);
       }
   }

}
