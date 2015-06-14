<!DOCTYPE html>
<html>
	<head>
		<title>Timer by Sarah Gebauer</title>
		<meta charset="UTF-8">
		<link href="style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<div id="countDownHolder">
			<h1 id="activity">All done</h1>
			<span id="minutes">0</span> : <span id="seconds">00</span>
			<button name="stopstart" id="stopstart" disabled="">Start</button>
		</div>
		<div id="formHolder">
				<textarea name="lines" id="txtAr"></textarea>
				<button id="setTimer">Set timer</button>
		</div>			
		<script type="text/javascript">
			var ssBtn = document.getElementById('stopstart');
			var stBtn = document.getElementById('setTimer');
			stBtn.addEventListener("click", timerSetter);
			var isRunning = false;
			ssBtn.addEventListener("click", startStopper);
			var data = []; /* [[name, time left s]] */
			var activityH1 = document.getElementById("activity");
			var minutesSpan = document.getElementById("minutes");
			var secondsSpan = document.getElementById("seconds");
			var txtAr = document.getElementById("txtAr");
			var pointer = 0;
			function startStopper() {
				if (isRunning) {
					isRunning = false;
					ssBtn.innerHTML = "Start";					
				} else {
					isRunning = true;
					ssBtn.innerHTML = "Stop";
					// tbd recalculation so screen saver isn't problem
				}
			}
			function timerSetter() {
				var linesAr = txtAr.value.split("\n");
				var len = linesAr.length;				
				for (var i = 0; i < len; i++) {
					data[i] = [];
					data[i][1] = linesAr[i].slice(0, linesAr[i].indexOf(" "));
					data[i][0] = linesAr[i].slice(linesAr[i].indexOf(" ")+1);
				}				
			}
			
			setInterval(function() {
				if (isRunning) {
					var minutes = data[pointer][1]%60;
					var seconds = data[pointer][1] - minutes;
					if (seconds == 0) {
						if (minutes == 0) {
							pointer++;
							if (pointer < data.length) {			
								activityH1.innerHTML = data[pointer][0];
								minutesSpan.innerHTML = data[pointer][1]%60;
							} else {
								activityH1.innerHTML = "All done";
								secondsSpan.innerHTML = "00";
								isRunning = false;
								ssBtn.innerHTML = "Start";
								pointer = -1;								
							}
						} else {
							seconds = 59;
							minutes--;
							minutesSpan.innerHTML = minutes;
						}											
					} else {
						data[pointer][1]--;											
					}
					if (seconds < 10) {
							seconds = "0"+seconds;
						}
					secondsSpan.innerHTML = seconds;										
				}
			}, 1000);
			
		</script>
	</body>
</html>