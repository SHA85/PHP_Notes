<?php
// Database configuration
$host = 'localhost';
$dbname = 'sample_database';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Get the table name from the request
$table = isset($_GET['table']) ? $_GET['table'] : null;

// Get the list of tables in the database
$tables = [];
foreach ($pdo->query('SHOW TABLES') as $row) {
    $tables[] = $row[0];
}

// Handle SQL query form submission
$queryResult = null;
$queryError = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sql'])) {
    $sql = $_POST['sql'];
    try {
        // Execute the query
        $stmt = $pdo->query($sql);

        // Check if the query returned any results
        if ($stmt->columnCount() > 0) {
            $queryResult = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            // If no results, it was likely an UPDATE, INSERT, or DELETE query
            $queryResult = "Query executed successfully.";
        }
    } catch (PDOException $e) {
        $queryError = "Error: " . $e->getMessage();
    }
}

// Pagination settings
$rowsPerPage = 500; // Default rows per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $rowsPerPage;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Mini MySQL Admin</title>
  <style>
    body { font-family: sans-serif; }
    table { border-collapse: collapse; width: 100%; }
    th, td { border: 1px solid #ddd; padding: 8px; }
    th { background-color: #f2f2f2; }
    form { margin-bottom: 20px; }
    textarea { width: 100%; height: 100px; }
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
	  text-decoration: none;
      border: 1px solid #ccc; 
	  padding: 3px;
    }
	.table-list li a {
	  text-decoration: none;
	}
	.table-list li.large {
	  background-color: red;
	  color: white;
	}
  </style>
</head>
<body>
<?php if ($tables): ?>

  <div class="table-list">
    <ul>
      <?php foreach ($tables as $tableName): ?>
        <li class="<?php echo $table == $tableName ?'large':''?>"><a href="?table=<?php echo $tableName; ?>"><?php echo $tableName; ?></a></li>
      <?php endforeach; ?>
    </ul>
  </div>

  <?php if ($table): ?>
    <h3>Execute SQL Query</h3>
    <form method="post">
      <textarea name="sql" placeholder="Enter your SQL query here"></textarea><br>
      <button type="submit">Execute</button>
    </form>

    <?php if ($queryResult): ?>
      <h3>Query Result</h3>
      <?php if (is_array($queryResult)): ?>
        <table>
          <thead>
            <tr>
              <?php foreach (array_keys($queryResult[0] ?? []) as $column): ?>
                <th><?php echo $column; ?></th>
              <?php endforeach; ?>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($queryResult as $row): ?>
              <tr>
                <?php foreach ($row as $value): ?>
                  <td><?php echo $value; ?></td>
                <?php endforeach; ?>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      <?php else: ?>
        <p><?php echo $queryResult; ?></p>
      <?php endif; ?>
    <?php endif; ?>

    <?php if ($queryError): ?>
      <p style="color: red;"><?php echo $queryError; ?></p>
    <?php endif; ?>

    <h3>Data</h3>
    <?php
    // Get the data from the selected table
    $stmt = $pdo->query("SELECT * FROM `$table`");
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <table>
      <thead>
        <tr>
          <?php foreach (array_keys($data[0] ?? []) as $column): ?>
            <th><?php echo $column; ?></th>
          <?php endforeach; ?>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data as $row): ?>
          <tr>
            <?php foreach ($row as $value): ?>
              <td><?php echo $value; ?></td>
            <?php endforeach; ?>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

  <?php endif; ?>

<?php else: ?>

  <p>No tables found in the database.</p>

<?php endif; ?>

</body>
</html>