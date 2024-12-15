<?php
session_start(); // เริ่มต้นเซสชัน
$open_connect = 1;
require('connect.php');

// ดึงข้อมูล Scoreboard จากฐานข้อมูล
$query = "SELECT username_account, score_account FROM account ORDER BY score_account DESC LIMIT 5";
$result = mysqli_query($connect, $query);

$scores = []; // สร้างอาร์เรย์สำหรับเก็บผลลัพธ์
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $scores[] = $row; // เก็บผลลัพธ์แต่ละแถวลงในอาร์เรย์
    }
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODtype</title>
    <link rel="stylesheet" href="styleplay.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body>
    
       <!-- Scoreboard Section -->
    <div class="scoreboard">
        <div class="profile">
            <span><?php echo isset($_SESSION['username_account']) ? $_SESSION['username_account'] : ''; ?></span>
        </div>

        
        <div class="metrics">
            <div>WPM: <span><?php echo isset($_SESSION['wpm_account']) ? $_SESSION['wpm_account'] : ''; ?></span></div>
            <div>Score: <span><?php echo isset($_SESSION['score_account']) ? $_SESSION['score_account'] : ''; ?></span></div>
        </div>


        <h3 class="underline">Scoreboard</h3>
        <div class="score-list">
            <?php if (!empty($scores)) : ?>
                <?php foreach ($scores as $index => $score) : ?>
                    <div class="score-item">
                        <?php echo "No." . ($index + 1) . " " . htmlspecialchars($score['username_account']) . " : " . htmlspecialchars($score['score_account']); ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="score-item">No scores available</div>
            <?php endif; ?>
        </div>

        
        <h3 class="underline">Mode</h3>
        <div class="mode">
            <div class="mode-item">
                <a href="play.php">Practice</a>
            </div>
            <div class="mode-item">
                <a href="speed.php">Speed Test</a>
            </div>
            <div class="mode-item">
                <a href="minigame.php">Game</a>
            </div>
            <div class="mode-item">
                <a href="index.php">Logout</a>
            </div>
        </div>
    </div>
          <!--END scoreboard section design-------------------->
    

    <div id="app">
        <!--<h1>MODtype</h1> -->
        <h1>Practice</h1> 

        <!-- เลือกเวลานับถอยหลัง -->
 
        
        <p id="text-to-type"></p>
        <input type="text" id="input-box" placeholder="Type the word...">
        <div id="timer">Time: 60 seconds</div> <!-- เวลาถอยหลังเริ่มต้นที่ 30 วินาที -->
        <div id="accuracy">Accuracy: 0%</div>
        <div id="character-count">Characters Typed: 0</div>
        <div id="status"></div> <!-- แสดงสถานะเมื่อพิมพ์เสร็จ -->
        <button onclick="startNewTest()">Restart</button>
        
        
    </div>

   
    <div id="popup" class="popup">
        <div class="popup-content">
            <h2 id="popup-status"></h2>
            <p id="popup-accuracy"></p>
            <p id="popup-time"></p>
            <p id="popup-typed"></p>
            <p id="popup-characters"></p>
            <p id="popup-wpm"></p>
            <button onclick="closePopup()">close</button>
        </div>
    </div>

    <script src="script.js"></script>


</body>
</html>
