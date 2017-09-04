<?php
define('DB_CONFIG_FILE', '/../data/config/db.config.php');
include __DIR__ . '/../Application/Database/Connection.php';
use Application\Database\Connection;
$conn = new Connection(include __DIR__ . DB_CONFIG_FILE);

// add function findCustomerById() here
function findCustomerById($id, Connection $conn)
{
    $stmt = $conn->pdo->query('SELECT * FROM customer WHERE id = ' . (int) $id);
    $results = $stmt->fetch(PDO::FETCH_ASSOC);
    return $results;
}
$id = random_int(1, 79);
$result = findCustomerById($id, $conn);
?>
<!DOCTYPE html>
<html>
<head>
<script src="https://code.jquery.com/jquery-1.12.0.min.js">
</script>
<script type="text/javascript" charset="utf8"
	src="//cdn.datatables.net/1.10.11/js/jquery.dataTables.js">
</script>
<link rel="stylesheet" type="text/css"
	href="//cdn.datatables.net/1.10.11/css/jquery.dataTables.css">
</head>
<body>
	<table id="customerTable" class="display" cellspacing="0" width="100%">
		<thead>
			<tr>
				<th>Transaction</th>
				<th>Date</th>
				<th>Qty</th>
				<th>Price</th>
				<th>Product</th>
			</tr>
		</thead>
	</table>
	<script>
    $(document).ready(function() {
        $('#customerTable').DataTable({ 
            "ajax": '/chap_05_jquery_datatables_php_lookups_ajax.php?id=<?= $id ?>'
        });
    });
	</script>
</body>
</html>