$(document).ready(function () {
 /* 
  $('#wrapper > #formular > fieldset > label > #unique').change(function () {
  if ($(this).prop('checked')) {
  $("#wrapper > #formular > #time").show();
  //   $("#wrapper > #formular > #time > .time > input").val("");
  } else {
  $("#wrapper > #formular > #time").hide();
  $("#wrapper > #formular > #time > .time > input").val("");
  }
  });
  */
});
//$(document).ready(function () {
// $('#wrapper > #formular > fieldset > label > #recorrence').change(function () {
//  if ($(this).prop('checked')) {
//   $("#wrapper > #formular > #time").hide();
//   $("#wrapper > #formular > #time > .time > input").val("");
//  } else {
//   $("#wrapper > #formular > #time").hide();
//   $("#wrapper > #formular > #time > .time > input").val("");
//  }
// });
//});



/* Neue Zeile Liefergebiet */
$(document).on("click", "#wrapper > #formular > #status > #description > .line_more", function () {
 $("#wrapper > #formular > #status > #table_rows").append('<tr class="row"><td class="left"><p>Menge</p><input type="text" name="amount" maxlength="5"></td><td class="right"><p>Beschreibung</p><input type="text" name="amount" maxlength="255"></td></tr>');
});
/* Liefergebiet entfernen.*/
$(document).on("click", "#wrapper > #formular > #status > #description > .delete_row", function () {
 $("#wrapper > #formular > #status > #table_rows > tbody > tr:last").last().remove().val();
//alert("qwer");
});
/* Alle Einträge markieren.*/
var alle_eintrage = "#wrapper > form > #aufgabentabellen > tbody > tr > td > input";
$(document).on("click", "#wrapper > form > #aufgabentabellen > tfoot > tr > td > #tab_optionen > #alles-markieren", function () {
 $(alle_eintrage).prop('checked', true);
});
$(document).on("click", "#wrapper > form > #aufgabentabellen > tfoot > tr > td > #tab_optionen > #markierung-entfernen", function () {
 $(alle_eintrage).prop('checked', false);
});



$(document).ready(function () {


 $('#aufgaben_auswahlliste > .aufgabe_zum_auswahl').each(function () {

  // make the event draggable using jQuery UI
  $(this).draggable({
   zIndex: 999,
   revert: true, // will cause the event to go back to its
   revertDuration: 0 //  original position after the drag
  });
 });


 (function ($) {
  $.timepicker.regional['de'] = {
   timeOnlyTitle: 'Zeit wählen',
   timeText: 'Zeit',
   hourText: 'Stunde',
   minuteText: 'Minute',
   secondText: 'Sekunde',
   millisecText: 'Millisekunde',
   microsecText: 'Mikrosekunde',
   timezoneText: 'Zeitzone',
   currentText: 'Jetzt',
   closeText: 'Fertig',
   timeFormat: 'HH:mm',
   timeSuffix: '',
   amNames: ['vorm.', 'AM', 'A'],
   pmNames: ['nachm.', 'PM', 'P'],
   isRTL: false
  };
  $.timepicker.setDefaults($.timepicker.regional['de']);
 })(jQuery);

 var aufgabenkalender = $("#aufgaben_kalender").fullCalendar({
  editable: true,
  eventLimit: true, // for all non-agenda views
  navLinks: true,
  lang: 'de',
  views: {
   agenda: {
	eventLimit: 6 // adjust to 6 only for agendaWeek/agendaDay
   }
  },
  header: {
   left: 'prev,next today',
   center: 'title',
   right: 'month,agendaWeek,agendaDay,listWeek'
  },
  eventSources: [
   {
	url: 'ajax/auslesen_einfach.php',
	color: 'green',
	textColor: 'white',
   },
   {
	url: 'ajax/auslesen_wiederkehrend.php',
	color: 'blue',
	textColor: 'white',
   },
   {
	url: 'ajax/auslesen_fertig.php',
	color: '#262626',
	textColor: 'white',
   }
  ],
  theme: true,
//  selectable: true,
  selectHelper: true,
  droppable: true,
//    drop: function () {
//      $(this).remove();
//    },

  eventClick: function (calEvent) {
   $.ajax({
	url: "ajax/lade-einzelnes-ereignis.php",
	type: "POST",
	data: {id: calEvent.id},
	success: function (result) {
	 $("#box > #aufgabe_bearbeiten").html(result);
	}
   });


  },

  eventReceive: function (event) {
   // Speichere Aufgabe in Kalender.
   var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
   var abgabetermin = event.abgabetermin;

   $.ajax({
	url: "ajax/speichern.php",
	type: "POST",
	data: {anfang: start, typ: event.typ, abgabetermin: abgabetermin, id: event.id},
	success: function () {
	 aufgabenkalender.fullCalendar("refetchEvents");
	}
   });
  },
  eventResize: function (event) {
   // Eventgröße in Kalender ändern.
   var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
   var abgabetermin = event.abgabetermin;
   var id = event.id;

   $.ajax({
	url: "ajax/zeit-aendern.php",
	type: "POST",
	data: {anfang: start, stop: end, abgabetermin: abgabetermin, id: id},
	success: function () {
	 aufgabenkalender.fullCalendar("refetchEvents");
	}
   });
  },
  eventDrop: function (event) {
   // Event in Kalender verschieben.  
   var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
   var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
   var abgabetermin = event.abgabetermin;

   var id = event.id;

   $.ajax({
	url: "ajax/tag-aendern.php",
	type: "POST",
	data: {anfang: start, stop: end, abgabetermin: abgabetermin, id: id},
	success: function () {
	 aufgabenkalender.fullCalendar("refetchEvents");
	}
   });
  },
  minTime: "06:00:00",
  maxTime: "18:00:00",
//    slotDuration:"00:15:00", // Die Frequenz für die Anzeige von Terminangeboten.
  height: "auto",
  weekends: false, // daktviere Sa, So.
  defaultView: 'agendaFourDay',
  views: {
   agendaFourDay: {
	type: 'agenda',
	dayCount: 4,
	default: "10:00:00",
   }
  }
 });

 $(function () {
  $("#wrapper > #linketeil > #aufgaben_auswahlliste > .aufgabe_zum_auswahl").draggable();
  $("#aufgaben_papierkorb").droppable({
   drop: function (event, ui) {
	ui.draggable.remove();
   }
  });
 });
});

/* speichere AJAX-Bemerkung. */
$(document).on("click", "#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #aufgabe_bearbeiten_bemerkung_schreiben > #speichere_ajax_bemerkung", function () {

 var aufgabe_id = $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_kopf > #aufgabe_id").val();
 var bemerkungstext = $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #aufgabe_bearbeiten_bemerkung_schreiben > #aufgabe_bemerkung_text").val();

 $.ajax({
  url: "ajax/speichere_bemerkung.php",
  type: "POST",
  data: {id: aufgabe_id, text: bemerkungstext},
  success: function (result) {
   $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #aufgabe_bearbeiten_bemerkungen > #aufgabe_geschriebene_bemerkung").last().html(result);
   $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #aufgabe_bearbeiten_bemerkungen > .aufgaben_bemerkung_nichts").remove();
   $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #aufgabe_bearbeiten_bemerkung_schreiben > #aufgabe_bemerkung_text").val("");
  }
 });
});

$(document).on("click", "#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #links_aufgabe_bearbeiten > #aufgabe_neu_bearbeiten", function () {

 var termin_id = $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_kopf > #termin_id").val();

 $.ajax({
  url: "ajax/aufgabe_status_aendern.php",
  type: "POST",
  data: {id: termin_id, typ: '1'},
  success: function (result) {
   $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #aufgabenstatus").html(result);
  }
 });
});

$(document).on("click", "#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #links_aufgabe_bearbeiten > #aufgabe_fertig", function () {

 var termin_id = $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_kopf > #termin_id").val();

 $.ajax({
  url: "ajax/aufgabe_status_aendern.php",
  type: "POST",
  data: {id: termin_id, typ: '2'},
  success: function (result) {
   $("#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_inhalt > #aufgabenstatus").html(result);
  }
 });
});


$(document).on("click", "#wrapper >#rechte_teil > #aufgaben_kalender > .fc-view-container > .fc-view > table > tbody > tr > td > .fc-scroller > .fc-time-grid > .fc-content-skeleton > table > tbody > tr > td > .fc-content-col > .fc-event-container > a", function () {
 $("#box").show();
});


$(document).on("click", "#box > #aufgabe_bearbeiten > #aufgabe_bearbeiten_kopf > #aufgabe_schliessen", function () {
 location.reload();
 $("#box").hide();
});

$(document).on("click", "#wrapper > #formular > button", function () {
 $("#box").show();
});