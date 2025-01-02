<?php
// Change Base Path
$BASE_PATH = 'C:\\laravel_project\\storage\\logs\\'; 

// Function to get log file content
function getLogContent($logFile) {
    global $BASE_PATH;
    $logPath = $BASE_PATH . $logFile;
    if (file_exists($logPath)) {
        return file_get_contents($logPath);
    } else {
        return 'Log file not found.';
    }
}

// Function to update log file content
function updateLogContent($logFile, $newContent) {
    global $BASE_PATH;
    $logPath = $BASE_PATH . $logFile;
    if (file_put_contents($logPath, $newContent) !== false) {
        return true;
    } else {
        return false;
    }
}

// Get the list of log files
$logFiles = glob($BASE_PATH . '*.log');

// Handle file viewing and editing
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $selectedLogFile = isset($_GET['file']) ? $_GET['file'] : 'laravel.log';
    $logContent = getLogContent($selectedLogFile);
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Log Viewer</title>
		<style>
			body { font-family: sans-serif; }
			table { border-collapse: collapse; width: 100%; }
			th, td { border: 1px solid #ddd; padding: 8px; }
			th { background-color: #f2f2f2; }
			form { margin-bottom: 20px; }
			textarea { width: 100%; }
			.table-list ul { 
			  list-style: none; 
			  padding: 0; 
			  margin: 0; 
			  display: flex;
			  flex-wrap: wrap;
			}
			.table-list li { 
			  width: calc(16.666% - 20px); /* 6 columns with some margin */
			  margin: 3px;
			}
		 </style>
    </head>
    <body>
        <div class="table-list">
			<ul>
				<?php foreach ($logFiles as $logFile): ?>
					<li><a href="?file=<?= basename($logFile) ?>"><?= basename($logFile) ?></a></li>
				<?php endforeach; ?>
			</ul>
		</div>
        <form method="POST">
            <input type="hidden" name="logfile" value="<?= $selectedLogFile; ?>"/>
            <br>
            <textarea name="log_content" rows="35"><?= htmlspecialchars($logContent) ?></textarea>
            <br>
            <button type="submit">Update Log File</button>
        </form>
    </body>
    </html>
    <?php
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedLogFile = $_POST['logfile']; 
    $newLogContent = $_POST['log_content'];

    if (updateLogContent($selectedLogFile, $newLogContent)) {
        // Redirect back to the main page after successful update
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit; 
    } else {
        echo "Failed to update log file.";
    }
}
?>