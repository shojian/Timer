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
			var data = []; /* [[name, time left s, computed time end s]] */
			var activityH1 = document.getElementById("activity");
			var minutesSpan = document.getElementById("minutes");
			var secondsSpan = document.getElementById("seconds");
			var txtAr = document.getElementById("txtAr");
			var pointer = 0;
			var stopTime = 0;
			function startStopper() {
				if (isRunning) {
					isRunning = false;
					ssBtn.innerHTML = "Start";	
					stopTime = Math.floor(Date.now()/1000);
				} else {
					isRunning = true;
					ssBtn.innerHTML = "Stop";
					var len = data.length;
					var temp = 0;					
					for (var i = pointer; i < len; i++) {
						data[i][2] = Math.floor(Date.now()/1000) + data[i][1]+temp;
						temp += data[i][1];
					}					
				}
			}
			function timerSetter() {
				var linesAr = txtAr.value.split("\n");
				var len = linesAr.length;				
				var now = Math.floor(Date.now()/1000);
				var temp = 0;
				for (var i = 0; i < len; i++) {
					data[i] = [];					
					data[i][1] = (linesAr[i].slice(0, linesAr[i].indexOf(" "))*60);
					data[i][2] = now + data[i][1]+temp;
					temp += data[i][1];
					console.log("data[i][2] "+data[i][2]);
					
					data[i][0] = linesAr[i].slice(linesAr[i].indexOf(" ")+1);
					if (i == 0) {
						activityH1.innerHTML = data[i][0];
						minutesSpan.innerHTML = Math.floor(data[i][1]/60);
						secondsSpan.innerHTML = "00";
					}
				}	
				ssBtn.removeAttribute("disabled");			
			}
			
			setInterval(function() {
				if (isRunning) {
					var now = data[pointer][2] - Math.floor(Date.now()/1000);								
					var minutes = Math.floor(now/60);
					var seconds = now%60;
					if (seconds == 0) {
						if (minutes == 0) {
							pointer++;							
							if (pointer < data.length) {		
								console.log(data[0][2] +" "+data[1][2] +" "+ Math.floor(Date.now()/1000));
								now = data[pointer][2] - Math.floor(Date.now()/1000);									
								minutes = Math.floor(now/60);
								seconds = now%60;
								console.log("min "+minutes+" seconds "+seconds)
								activityH1.innerHTML = data[pointer][0];
								minutesSpan.innerHTML = minutes;
								secondsSpan.innerHTML = seconds;
							} else {
								activityH1.innerHTML = "All done";
								secondsSpan.innerHTML = "00";
								isRunning = false;
								ssBtn.innerHTML = "Start";
								pointer = 0;								
							}
						} else {
							seconds = 59;
							minutes--;
							minutesSpan.innerHTML = minutes;
						}											
					} else {
						minutesSpan.innerHTML = minutes;
						secondsSpan.innerHTML = seconds;										
					}
					if (seconds < 10) {
							seconds = "0"+seconds;
					}
					data[pointer][1]--;
					minutesSpan.innerHTML = minutes;
					secondsSpan.innerHTML = seconds;										
				}
			}, 1000);
			
		</script>
	</body>
</html>