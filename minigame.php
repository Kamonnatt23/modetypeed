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
    <title>MODtype minigame</title>
    <link rel="stylesheet" href="stylegame.css">
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
                <a href="index.html">Logout</a>
            </div>
        </div>
    </div>
          <!--END scoreboard section design-------------------->
 

    <div class="minigame">

        <div id="game-container">

            <!-- ชื่อ MODE -->
            <h1>Game</h1>

            <div class="count-box">        
                <div class="small-box">
                    <div id="timer">Time: 60</div>
                    <div id="score">Score: 0</div>
                    <div id="character-count">Characters Typed: 0</div>
                </div>
            </div>

            <div class="container">
                <!-- Added falling-words-container -->
                <div class="word-box">
                    <div id="falling-words-container"></div>
                </div>
                 <!-- Input box -->
                 <input type="text" id="input" placeholder="Type the word..." autofocus />
            </div>
        </div>
    
        <!-- Modal for Start -->
        <div id="start-modal" class="modal">
            <div class="modal-content">
                <h2>Welcome to MODtype minigame!</h2>
                <p>Click the button to start the game.</p>
                <button id="start-btn" onclick="startGame()">Start Game</button>
            </div>
        </div>
        

        <!-- Modal for End -->
        <div id="end-modal" class="modal">
            <div class="modal-content">
                <h2>GAME OVER!</h2>
                <p id="end-message">Your score is 0.</p>
                <p id="total-characters">Total characters typed: 0</p> <!-- New paragraph for characters -->
                <p id="wpm">WPM: 0</p> <!-- New paragraph for WPM -->
                <button id="restart-btn">Close</button>
            </div>
        </div>
    

    </div>

    <script src="scriptgame.js?v=1"></script>
    <script>
        // Function to show the start modal
        function showStartModal() {
            const startModal = document.getElementById('start-modal');
            const endModal = document.getElementById('end-modal');
            startModal.style.display = 'flex';
            endModal.style.display = 'none';
            centerModal(startModal);
        }

        // Function to show the end modal
        function showEndModal() {
            const startModal = document.getElementById('start-modal');
            const endModal = document.getElementById('end-modal');
            startModal.style.display = 'none';
            endModal.style.display = 'flex';
            centerModal(endModal);
        }

        // Function to center the modal
        function centerModal(modal) {
            modal.style.justifyContent = 'center';
            modal.style.alignItems = 'center';
        }

        // Function to start the game
        function startGame() {
            document.getElementById('start-modal').style.display = 'none';
            // Add your game start logic here
        }

        // Function to restart the game
        function restartGame() {
            document.getElementById('end-modal').style.display = 'none';
            showStartModal();
            // Add your game restart logic here
        }

        // Example usage: Show the start modal when the page loads
        window.onload = function() {
            showStartModal();
        };
    </script>
</body>
</html>