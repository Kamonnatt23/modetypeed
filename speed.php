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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Speed Test Game</title>
  <link rel="stylesheet" href="stylespeed.css">
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

  <div id="game">
    <!-- เก่า -->
    <!-- <button id="start-btn">Start MODspeed</button> -->

    <!-- Modal for Start -->
    <div id="start-modal" class="modal">
      <button id="start-btn" class="modal-content">
        <p class="one">Start MODspeed</p>
      </button>
    </div>

    <div id="score-time" class="hidden">
      <div class="small-box">
        <div id="time">Time: 60</div>
        <div id="score">Score: 0</div>
        <div id="character-count">Characters Typed: 0</div>
      </div>
    </div>

    <div class="container">

      <!-- ชื่อ MODE -->
      <h1 id="mode" class="hidden">MODspeed</h1>

      <div id="word-container" class="hidden">
        <span id="word"></span>
      </div>
  
      <input type="text" id="input" class="hidden" placeholder="Type the word" autocomplete="off">



    </div>

  </div>

  <div id="popup" class="hidden">
    <div class="modal-content">
      <h2>GAME OVER!</h2>
      <p>Your <span id="final-score"></span></p>
      <p><span id="final-characters"></span></p> <!-- Display Total Characters Typed -->
      <p><span id="final-wpm"></span></p> <!-- Added WPM display -->
      <button id="restart-btn">Restart</button>
    </div>
  </div>


  <script src="scriptspeed.js?v=1"></script>
</body>
</html>