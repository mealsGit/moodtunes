<!doctype html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta charset="UTF-8">
	<title>Moodtunes -- Tunes for your Mood</title>
	<!--JQUERY-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<!--BOOTSTRAP CSS-->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">   
	<!--BOOTSTRAP JAVASCRIPT-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="shortcut icon" href="assets/images/favicon.ico">
	<link rel='shortcut icon' type='image/x-icon' href='moodtunes-alt-favicon.ico' />    
</head>

<body>
<div id="mood-colors">
<div id="aquasplash" class="mood-color">
</div>
<div id="bloodred" class="mood-color">
</div>
<div id="spacedust" class="mood-color">
</div>
<div id="dawnlight" class="mood-color">
</div>
</div>
<div id="wrapper">
	<div class="container">
		<div id='submitContent'>
			<!--<span class="glyphicon glyphicon-pause" id="pause"></span>-->
  			<figure id='audioplayer' style='display:inline-block;'>
				<h3><span id="nowPlaying">No audio selected</span> <span id="tuneTitle"></span></h3>
				<div id="audiocontrols"><button class="glyphicon glyphicon-play" id="play"></button></div>			  
				<audio id='audiotrack' loop>
					<source id="tuneLink" src='' type='audio/mpeg'>
				</audio>
  			</figure>
		</div>

		<header>
			<div class="">
				<div class="col-md-12" style="padding:0; float:none;">
					<h1><img src="assets/images/moodtunes-thick.svg" alt=""><!--moodtunes--></h1>
					<h2>Tunes for <span>your</span> mood</h2>
				</div>
			</div>
		</header>

		<main>
			<div class="row">
			<div class="col-md-12"><h4>Select the musical attributes you would like to hear and press the 'Get My Tune!' button below (<strong>audio warning</strong>)!</h4>
			</div>
			
        	<form id="tuneOptions">
				<div class="col-md-3">
					<select name="volume" id="volume">
						<option value="none">(style)</option>
						<option value="0" id="loud">heavy</option>
						<option value="1" id="quiet">soft</option>
					</select>
				</div>
				
				<div class="col-md-3">
					<select name="tempo" id="tempo">
						<option value="none"><h1>(tempo)</h1></option>
						<option value="0" id="fast">fast</option>
						<option value="1" id="slow">slow</option>
					</select>
				</div>

				<div class="col-md-3">
					<select name="complexity" id="complexity">
						<option value="none">(complexity)</option>
						<option value="0" id="complex">complex</option>
						<option value="1" id="simple">simple</option>
					</select>
				</div>

				<div class="col-md-3">
					<select name="key" id="key">
						<option value="none">(key)</option>
						<option value="0" id="minor">minor key</option>
						<option value="1" id="major">major key</option>
					</select>
				</div>
			
            	<div id="submitDiv" class="col-md-12">
					<input type="submit" name="submit" id="submit" value="Get My Tune!" onclick="checkValue()">
				</div>
				</div>
			</form>
			<footer>
			<p>Moodtunes is a site made by <a href="http://mylesmalloy.com/">Myles Malloy</a> as a school project in 2015. All music was created by Myles using GarageBand.</p>
		</footer>
		</main>
	</div>
	</div>
<script>

var booleanArray = [0,1];

function randomize(array) {
  var currentIndex = array.length, temporaryValue, randomIndex;

  // While there remain elements to shuffle...
  while (0 !== currentIndex) {

    // Pick a remaining element...
    randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    // And swap it with the current element.
    temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

randomize(booleanArray);
var randomVal = booleanArray[0];

var selected_option = ($('#key option:selected').val());


function checkValue(){
	//if ((tuneOptions.volume.value=='none') || (tuneOptions.tempo.value=='none') || (tuneOptions.complexity.value=='none') || (tuneOptions.key.value=='none'))
		$( "#tuneOptions select").each(function() {
			if ($(this).val() == "none") {
				randomize(booleanArray);
				//alert(booleanArray[0]);
				$(this).val(booleanArray[0]);
				//alert($(this).val());
			}
		});
		/*if($('#key option:selected').val() == "none") {
			alert("none");
		}*/
	} 

function get_selection () {

    var url = 'music.php'

    url += ('' == tuneOptions.volume.value)?     '?volume=1':     '?volume='     + tuneOptions.volume.value
    url += ('' == tuneOptions.tempo.value)?      '&tempo=1':      '&tempo='      + tuneOptions.tempo.value
    url += ('' == tuneOptions.complexity.value)? '&complexity=1': '&complexity=' + tuneOptions.complexity.value
    url += ('' == tuneOptions.key.value)?        '&key=1':        '&key='        + tuneOptions.key.value

    var xhr = new XMLHttpRequest()
    xhr.open('GET', url, true)
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded')

    xhr.onload = function () {

        var music = JSON.parse(this.responseText)
        document.getElementById('tuneTitle').innerHTML = music.title
        var audio = document.getElementById('audiotrack')
        document.getElementById('tuneLink').src = music.link
        audio.load()
		audio.play()
		
		  
    }
    xhr.send();
	
	if ($("#play").hasClass("glyphicon-play")) {
		$("#play").removeClass("glyphicon-play");
		$("#play").addClass("glyphicon-pause");
	}
	
	$("#nowPlaying").html("Now Playing:");
	
}

document.getElementById('tuneOptions').addEventListener('submit', function(evt){
    evt.preventDefault()
    get_selection()
})

function setText(el,text) {
	el.innerHTML = text;
}

function setAttributes(el, attrs) {
	for(var key in attrs){
		el.setAttribute(key, attrs[key]);
	}
}

//AUDIO PLAYER//

var audioPlayer = document.getElementById("audioplayer"),
audioTrack = document.getElementById("audiotrack");
tuneLink = document.getElementById("tuneLink");
audioControls = document.getElementById("audiocontrols");
volumeSlider = document.createElement("input");
volumeSlider.id = "volumeslider";
playButton = document.getElementById("play");
pauseButton = document.getElementById("pause");
setAttributes(volumeSlider, {"type": "range", "min": "0", "max": "1", "step": "any", "value": "1"});
audioControls.appendChild(volumeSlider);
audioTrack.removeAttribute("controls");

volumeSlider.addEventListener("input", function(){ audioTrack.volume = volumeSlider.value;
});

playButton.addEventListener("click", player);

function player() {
	if(!$("#tuneLink").attr("src")=="") {
		if (audioTrack.paused) {
			audioTrack.play();
			$("#play").removeClass("glyphicon-play");
			$("#play").addClass("glyphicon-pause");
		} else {
			audioTrack.pause();
			$("#play").removeClass("glyphicon-pause");
			$("#play").addClass("glyphicon-play");
		}
	} else {
		alert("Please click the 'Get My Tune!' button before using controls.");
	}
}
//pauseButton.addEventListener("click", pauser);


</script>

</body>
</html>
