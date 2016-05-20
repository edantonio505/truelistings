$(document).foundation();

$('.ui.dropdown').dropdown();
$(window).load(function(){
  $(".pageLoader").fadeOut('slow');
});

//--------------------------Submit new search query from search results-----------------------
$(".inputQuery_text").keypress(function(e){
 if(e.which == 13) {
        $(".formQuery").submit();
    }
});

$(".inputQuery").change(function(){
  $(".formQuery").submit();
});
//-------------------------------------------------------------------------------------------





// ----------------------------------Price Range set-----------------------------------
$('.ui-autocomplete').addClass('f-dropdown');
$(".slider").mousemove(function(e){
  var minSlider = Math.round($("#minSlider").val() * 200);
  var maxSlider = Math.round($("#maxSlider").val() * 200);
  $("#minSlider1").val(minSlider);
  $("#maxSlider1").val(maxSlider);
  $(".minSlider").text(minSlider);
  $(".maxSlider").text(maxSlider);
});

$(".close-button").click(function(e){
  $(".callout").fadeOut();
});
// -------------------------------------------------------------------------------------








// -------------------data autocomplete Creating or Editing new Property Form---------
$("#geocomplete").geocomplete({
  details: "form",
  types: ["geocode", "establishment"],
});
$("#find").click(function(){
  $("#geocomplete").trigger("geocode");
  $("#geocomplete").bind("geocode:result", function(event, result){
  	var route = result.address_components[0].long_name;
  	var street = result.address_components[1].long_name;
  	$("#address").val(route+" "+street);
  	var str = $("#address").val();
  	str = str.replace(/\s+/g, '-');
  	$("#slug").val(str);
    $("#picture-text").hide();
    $("#picture-form").show();
    $("#initial_property_id").val(str);
  });
});
//------------------------------------------------------------------------------------





//--------------------------Sale type and subtype selection-----------------
$('#sale-type').click(function(e){
  var sale_type = $("#sale-type").val();
  if(sale_type == 'rent'){
    $("#building-rental").attr("name", "sale_sub_type").show();
    $("#building-sale").hide().removeAttr('name');
  } else if (sale_type == 'sale')
  {
    $("#building-sale").attr("name", "sale_sub_type").show();
    $("#building-rental").hide().removeAttr('name');
  }
});
//-------------------------------------------------------------------------




//---------check if new property has values before allowing picture uploads-----
$("#picturePanel").click(function(){
  if($("#slug").val() != '')
  {
    $("#picture-text").hide();
    $("#picture-form").show();
  }
});
//------------------------------------------------------------------------------





//--------------delete a photo from a property-------------------------
$(".delete-picture").click(function(){
  var id =  $(this).attr('data-id');
  var token = $("#picture_token").val();
  $.post({ 
    url: "/delete_photo/"+id+'?_token='+token
  }).done(function(data){
    $(".picture_container-"+id).fadeOut();
  });
});
//---------------------------------------------------------------------







//-------------------------------Saving Edit-------------------------------
$(".saveInputFillButton").click(function(){
  var address = $("#address").val();
  var zip = $("#postal_code").val();
  var lng = $("#lng").val();
  var lat = $("#lat").val();
  var slug = $("#slug").val();
  var alert = $(".savedAlert");
  var data = {'postal_code': zip, 'address': address,'lng': lng, 'lat':lat, 'slug':slug}
  save(data, alert);
});

$(".saveEditedText").click(function(){
  saveTyping($(this), $("."+$(this).attr('name')+"Alert"));
});

$(".saveEditedText").focusout(function(){
  save(addCheckboxes(getType($(this).attr('name'), $(this).val())),$("."+$(this).attr('name')+"Alert"));
});

$(".saveEditedSelect").change(function(){
  data = getType($(this).attr('name'), $(this).val());
  data = addCheckboxes(data);
  message = $("."+$(this).attr('name')+"Alert");
  save(data, message);
});

$(".saveEditedCheckbox").click(function(){
 saveCheckedCheckbox();
});

function getType(type, val)
{
  data = {};
  data[type] = val;
  return data;
}

function alertSave(alert)
{
  if (alert.is(":visible")) { return; }
  alert.fadeIn();
  setTimeout(function() {
      alert.fadeOut();
  }, 3000);
}

function save(data, message)
{ 
  var property_id = $("#property_id").val();
  var token = $("#token").val();
  $.post({
    url: '/save_edited/?_token='+token+'&property_id='+property_id,
    data: data
  }).done(function(data){
    console.log(data);
    alertSave(message);
  }).fail(function(data) {
    alert(data);
  });
}

function saveTyping(input, message)
{
  var typingTimer;                
  var doneTypingInterval = 1000; 
  var $input = input;
  $input.on('keyup', function () {
    clearTimeout(typingTimer);
    typingTimer = setTimeout(doneTyping, doneTypingInterval);
  });
  $input.on('keydown', function () {
    clearTimeout(typingTimer);
  });
  function doneTyping () {
    data = addCheckboxes(getType($input.attr('name'), $input.val()));
    save(data, message);
  }
}

function saveCheckedCheckbox()
{
  var val = {};
  $(':checkbox:checked').each(function(){
    val[$(this).attr('name')] = $(this).val();
  });
  data = val;
  message = $(".checkboxAlert");
  save(data, message)
}

function addCheckboxes(data)
{
  $(':checkbox:checked').each(function(){
    data[$(this).attr('name')] = $(this).val();
  });
  return data;
}
//-----------------------------------------------------------------------



//----------------------------------Saving "on the fly"---------------------
$(".selectableRow").click(function(){
  var property_id = $(this).attr('data-id');
  if($(this).hasClass('selectedRow'))
  { 
    $("#formInstructions").fadeIn('slow');
    $("#formVisible"+property_id).hide('blind');
    $(this).removeClass('selectedRow');
  } else {
    $("#formInstructions").fadeOut('fast');
    $("#formVisible"+property_id).show('blind');
    $(".selectableRow").removeClass('selectedRow');
    $(this).addClass('selectedRow');
    $(this).siblings().on( "click", function() {
      $("#formVisible"+property_id).hide().addClass('');
    });
  }
});

$(".onTheFly").click(function(){
  var data = {};
  $this = $(".selectedRow");
  var property_id = $this.attr('data-id');
  var checkboxes = $("#formVisible"+property_id).find(':checkbox:checked');
  checkboxes.each(function(){
      data[$(this).attr('name')] = $(this).val();
  });
  var token = $("#token").val();
  $.post({ 
    url: '/property_save_selling_points_on_the_fly/?_token='+token+'&property_id='+property_id,
    data: data
  }).done(function(response){
    if(response != "SellingPointIncomplete"){
      $this.removeClass("SellingPointIncomplete");
    } else {
      $this.addClass("SellingPointIncomplete");
    }
  });
});
// -------------------------------------------------------------------------


//  -------------------------------Delete a Property--------------------------
$('.deleteProperty').click(function(){
  var id = $(this).attr('property-id');
  var token = $(this).attr('token');
  var property_row = $('tbody').find("[data-id='" + id + "']");
  $.ajax({
    method: "POST",
    url: "/delete_property",
    data: { id: id, _token: token}
  })
  .done(function(response) {
      if(response === 'deleted')
      {
        property_row.fadeOut();
      }
  });
});
// ---------------------------------------------------------------------------


//-------------------------Are you a broker----------------------------------
$("#showInputLicense").change(function() {
    var brokerLicense = $("#brokerLicense");
    if(this.checked) {
       brokerLicense.show();
    } else {
      brokerLicense.hide();
    }
});

// --------------------------------------------------------------------------