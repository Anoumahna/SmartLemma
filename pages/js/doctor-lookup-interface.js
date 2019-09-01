var Doctor = require('./../js/doctor-lookup.js').doctorModule;

var row = function() {
  $('#table-body').append(`<tr></tr>`);
};

var displayDocName = function(doc_name){
  $('tr').last().append(`<td>${doc_name}</td>`);
};

var displayTitle = function(title){
  $('tr').last().append(`<td>${title}</td>`);
};

var displaySpeciality = function(specialty){
  $('tr').last().append(`<td>${specialty}</td>`);
};

var displayPracticeName = function(practice_name){
  $('tr').last().append(`<td>"${practice_name}"</td>`);
}

var displayaddress = function(address){
  $('tr').last().append(`<td>"${address}"</td>`);
};


$(document).ready(function(){
  var currentDoctorObject = new Doctor();
  $(".table").hide();
  $("#recommend").hide();
  $("#findDoc").submit(function(e){
    e.preventDefault();
    var medicalIssue = $('#medicalIssue').val();
    $("#recommend").show();
    $(".table").show();
    currentDoctorObject.getDoctors(medicalIssue,row, displayDocName, displayTitle, displaySpeciality, displayPracticeName,displayaddress);
  });
  $('#refresh').click(function() {
      location.reload();
    });
});
