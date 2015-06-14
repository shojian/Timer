<!DOCTYPE html>
<html>
	<head>
		<title>Timer by Sarah Gebauer</title>
		<meta charset="UTF-8">
	</head>
	<body>
		<div id="countDownHolder">
			<h1 id="activity">All done</h1>
			<span id="minutes">0</span> : <span id="seconds">00</span>
			<button name="stopstart" id="stopstart" disabled="">Start</button>
		</div>
		<div id="formHolder">
			<form action="timer.php" method="post">
				<textarea name="lines"></textarea>
				<button id="setTimer">Set timer</button>
			</form>
		</div>			
		<script type="text/javascript">
			var ssBtn = document.getElementById('stopstart');
			var stBtn = document.getElementById('setTimer');
			stBtn.addEventListener("click", timerSetter);
			var isRunning = false;
			ssBtn.addEventListener("click", startStopper);
			var data = <?php if (isset($linesFinArr)) echo json_encode($linesFinArr); else echo json_encode([]) ?>;
			var activityH1 = document.getElementById("activity");
			var minutesSpan = document.getElementById("minutes");
			var secondsSpan = document.getElementById("seconds");
			var pointer = 0;
			activityH1.innerHTML = data[0][0];
			minutesSpan.innerHTML = data[0][1];
			function startStopper() {
				if (isRunning) {
					isRunning = false;
					ssBtn.innerHTML = "Start";
				} else {
					isRunning = true;
					ssBtn.innerHTML = "Stop";
				}
			}
			
			setInterval(function() {
				if (isRunning) {
					var minutes = parseInt(minutesSpan.innerHTML);
					var seconds = parseInt(secondsSpan.innerHTML);
					if (seconds == 0) {
						if (minutes == 0) {
							pointer++;
							if (pointer < data.length) {								
								activityH1.innerHTML = data[pointer][0];
								minutesSpan.innerHTML = data[pointer][1];
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
						seconds--;											
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