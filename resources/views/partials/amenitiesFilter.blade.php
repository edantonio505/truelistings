<script>
  var value = [];
  var val = 0;

//------------------------------Buttons clicked trigger this---------------------------------------
$(".filter").click(function(e){
  if($(".filter-container").children(".selected").length == 1){
    $(".match").show();
    $(".calculated").hide();
    resetToDefaultValues();
  }

  var $this = $(this);
  if(!$this.hasClass("selected")){
    addToFilter($this);
  }else{
    removeFromFilter($this);
  }
});




function removeFromFilter($this){
  $this.removeClass("selected");
  $this.css("background-color", '#2199e8');
  filter = $this.attr('data-filter');
  var indexOfArray = value.indexOf(filter);
  value.splice(indexOfArray, 1);
  val = 20 / (value.length);
  console.log(val);
  showResultOfCalculation(val);
  mixItUp();
}


function addToFilter($this){
  $this.addClass("selected");
  $this.css("background-color", '#194570');
  $(".match").css("display", 'none');
  $(".calculated").show();
  filter = $this.attr('data-filter');
  value.push(filter);
  val = 20 / (value.length);
  console.log(val);
  showResultOfCalculation(val);
  mixItUp();

}

//-----------------------Loops trough all the elements in the results and looks for the ----------
function showResultOfCalculation(val){
  $(".result-box").each(function(index, element){
    var initialcal = Number($(element).find(".calculated-match").text());
    var flag = 0;
    var FinalResShow = $(element).find(".calculated-match2");

    value.forEach(function(i){
      if($(element).hasClass(i) === true){
        flag += 1;
        getFinalCal(element, FinalResShow, val, flag, initialcal);
      } else {
        flag += 0;
        getFinalCal(element, FinalResShow, val, flag, initialcal);
      }
    });
  });
}

function resetToDefaultValues(){
  $(".result-box").each(function(index, element){
    var initialcal = Number($(element).find(".calculated-match3").text());
    $(element).attr("data-order", initialcal);
  });
}

function getFinalCal(element, FinalResShow, val, flag, initialcal){
  var finalcal = Math.round(val * flag) + initialcal;
  $(element).attr("data-order", finalcal);
  FinalResShow.text(finalcal);
}


function mixItUp(){
  $('#container').mixItUp({
    animation: {
      effects: 'fade rotateY(-10deg)',
      duration: 300
    }
  });
}
</script>