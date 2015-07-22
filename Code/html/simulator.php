<?php
    
    include_once("parseHeader.php");
    
    use Parse\ParseUser;
    use Parse\ParseObject;
    use Parse\ParseException;
    use Parse\ParseQuery;
    
    $currentUser = ParseUser::getCurrentUser();
    $username;
    
    if ($currentUser) {
        //$username = $currentUser->getObjectId();
        //echo $currentUser->getUsername();
        $query1 = new ParseQuery("AssignedRoutines");
        $query1->equalTo("user",$currentUser);
        $username = $currentUser->getUsername();
    } else {
        // show the signup or login page=
        Header('Location:index.php');
    }
    
?>
<!DOCTYPE html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>SkillCourt Simulator</title>
		<meta name="Generator" content="Processing" />
        <link rel="stylesheet" type="text/css" href="style/Simulator.css">
        <link rel="stylesheet" type="text/css" href="style/index.css">
		<script src="processing.js" type="text/javascript"></script>
	</head>
	<body>
        <?php include 'navigation_bar.php'; ?>
            <div id="phoneBackground"></div>
		<div id="SimSettings">
			<ul id="tabs">
				<li>
					<button onclick="showDefault();">Default</button>
				</li>
				<li>
					<button onclick="showCustom();">Custom</button>
				</li>
			</ul>
			<div class="SettingsList" id="CustomList">
				<ul>
                    <li><select id="customRoutineList">
                    <?php
                        if ($currentUser) {
                            $query1->equalTo("type","Custom");
                            $results1 = $query1->find();
                            if (count($results1) > 0){
                                for ($i = 0; $i < count($results1); $i++) {
                                    $res = $results1[$i]->get("customRoutine");
                                    $res->fetch();
                                    echo "<option ". "value=" . $res->get("command")  .">".$res->get("name")."</option></br>";
                                }
                            }
                        }
                    ?>
                    </select></li>
					<li><button id="quickStartButton" onclick="quickStartGame();" >Play!</button></li>
				</ul>
			</div>
			<div class="SettingsList" id="DefaultList" >
				<p>SkillCourt Routines</p>
				<ul>
					<li><input id="customRoomCheck" type="checkbox" onclick="switchCustom();"/>Remove Wall</li>
					<li><select id="removedWall">
							<option value="1" selected="true">North</option>
							<option value="2">East</option>
							<option value="3">South</option>
							<option value="4">West</option>
						</select></li>	
					<li>Choose a Routine:</li>
					<li><select id="routineType" onchange="allowRounds();">
							<option name="routine" value="t"selected="true">Three Wall Chase</option>
							<option name="routine" value="c">Chase</option>
							<option name="routine" value="h">Fly</option>
							<option name="routine" value="g">Home Chase</option>
							<option name="routine" value="j">Home Fly</option>
							<option name="routine" value="m">Ground Chase</option>
							<option name="routine" value="x">X-Cue</option>
						</select></li>
					<li>Choose the Difficulty:</li>
					<li id="difficultyRadioButton">
						<input type="radio" name="difficulty" value="n" checked="true">Novice<br>
						<input type="radio" name="difficulty" value="i">Intermediate<br>
						<input type="radio" name="difficulty" value="a">Advanced</li>
					<li>Time Per Round</li>
					<li><input id="timePerRoundCheck" type="checkbox" onclick="myFunction2();">
						<input id="timePerRound" type="number" min="1" max="30" disabled>
						seconds</li>
					<li>Play By</li>
					<li>
						<select id="gameType">
							<option value="time" selected="true">Time (minutes)</option>
							<option value="rounds">Rounds</option>
							<input type="number" id="amount" min="1" max="30" value="1">
						</select></li>
					<li ><button onclick="startGame();">Play!</button></li>
                </ul>
			</div>

			<div id="FeedbackList">
				<p>SkillCourt Performance</p>
				<ul>	
					<li>Successes: <span id="successesNum"><span></li>
					<li>Minus Points: <span id="minusNum"></span></li>
					<li>Misses: <span id="missesNum"></span></li>
					<li>Accuracy: <span id="accuracyNum"></span></li>
					<li>Average Force: <span id="forceNum"></span></li>
					<li>AR Shot Time: <span id="arTimeNum"></span></li>
					<li>AR Dribbling Time: <span id="dribbleTimeNum"></span></li>
					<li>xPRS Speed: <span id="xprs"></span></li>
					<li><button onclick="stopGame();">STOP</button></li>
				</ul> 
			</div>
		</div>

		<div id="Simulator">
				<br><br><br>
				<canvas id="sketch" data-processing-sources="simulator/simulator.pde" width="600" height="600">
					<p>Your browser does not support the canvas tag.</p>
				</canvas>
				<noscript>
					<p>JavaScript is required to view the contents of this page.</p>
				</noscript>
		</div>

		<script src="buzz.min.js"></script>
        <script src="simulator.js"></script>
        <script>
                <?php if (isset($_GET['rc'])): ?>
                    <?php if (isset($_GET['rt'])) : ?>
                        document.getElementById("DefaultList").style.display = "none" ;
                        document.getElementById("CustomList").style.display = "block" ;
                        customRoutineCommand = <?php echo "\"".$_GET['rc']."\"" ?>;
                        //customRoutineCommand = "U02R_01*122132142SNR_01*320330331SN";
                        //customCoachRoutine = true;
                        //isReadyToPlay = true;
                    <?php else : ?>
                        document.getElementById("DefaultList").style.display = "block" ;
                        document.getElementById("CustomList").style.display = "none" ;
                        var rout = <?php echo "\"".$_GET['rc']."\"" ?>;
                        console.log(rout);
                        var rt = rout.charAt(0);
                        var rdiff = rout.charAt(1);
                        var rounds = parseInt(rout.substring(2, 4));
                        var gametime = parseInt(rout.substring(6,9));
                        var timebased = parseInt(rout.substring(9,11));

                        document.getElementById("routineType").value = rt;
                        console.log("rounds: "+rounds)
                        if (rounds > 0)
                        {
                            document.getElementById("gameType").value = "rounds";
                            document.getElementById("amount").value = rounds;
                        } else {
                            document.getElementById("gameType").value = "time";
                            document.getElementById("amount").value = gametime;
                        }

                        if(parseInt(rout.charAt(4)) == 0)
                        {
                            document.getElementById("customRoomCheck").checked = false;
                        } else {
                            document.getElementById("customRoomCheck").checked = true;
                            document.getElementById("removedWall").value = parseInt(rout.charAt(5));
                            document.getElementById("removedWall").style.display = "block";
                        }

                        if(timebased>0)
                        {
                            document.getElementById("timePerRoundCheck").checked = true;
                            document.getElementById("timePerRound").value = timebased;
                        } else {
                            document.getElementById("timePerRoundCheck").checked = false;
                        }

                        routineCommand = rout;
                        //isReadyToPlay = true;
                        //playScreen();
                        //document.getElementById("FeedbackList").style.display = "block" ;

                    <?php endif ; ?>
                <?php endif ; ?>
        </script>
	</body>
</html>