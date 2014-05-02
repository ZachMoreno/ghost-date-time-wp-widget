// Date & Time
function startTime() {
   var week     = new Array(7); // weekdays
       week[0]  = "Sunday";
       week[1]  = "Monday";
       week[2]  = "Tuesday";
       week[3]  = "Wednesday";
       week[4]  = "Thursday";
       week[5]  = "Friday";
       week[6]  = "Saturday";

   var months    = new Array();
       months[0]  = "January";
       months[1]  = "February";
       months[2]  = "March";
       months[3]  = "April";
       months[4]  = "May";
       months[5]  = "June";
       months[6]  = "July";
       months[7]  = "August";
       months[8]  = "September";
       months[9]  = "October";
       months[10] = "November";
       months[11] = "December";

   var today   = new Date(),
       hours24 = today.getHours(), // hour24
       hours   = ((hours24 + 11) % 12) + 1, // standard hours
       amPm    = hours24 > 11 ? 'pm' : 'am',
       minutes = today.getMinutes(), // minute
       seconds = today.getSeconds(), // second
       date    = today.getDate(), // day #
       month   = months[today.getMonth()], // month
       year    = today.getFullYear(), // year
       day     = week[today.getDay()]; // day name

   // add a zero in front of numbers<10
   minutes = checkTime(minutes);
   seconds = checkTime(seconds);


   if(document.getElementById('date') != null) {
       document.getElementById('date').innerHTML = day + " / " + month + " " + date + " / " + year;
       document.getElementById('time').innerHTML = hours + ":" + minutes + "<span>" + amPm + "</span>";
       t=setTimeout(function(){startTime()},500);
   }
   
}

function checkTime(i) {
   if (i<10) {
       i="0" + i;
   }
   return i;
}

jQuery(function(){
   startTime();
});

WebFontConfig = {
    google: { families: [ 'Roboto:400,300:latin' ] }
  };
  (function() {
    var wf = document.createElement('script');
    wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
      '://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
    wf.type = 'text/javascript';
    wf.async = 'true';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(wf, s);
  })();