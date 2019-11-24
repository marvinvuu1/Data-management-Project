<?php
		session_start();
		$link = mysqli_connect('localhost','root','demo','warehouse');
		if ($link === false) 
		{
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}

		$searchval = $_GET['num'];

		if ($searchval == 1)
		{
			$name = $_GET['name'];
			$sql = "SELECT * FROM `employees` WHERE Salary > ALL (SELECT Salary FROM employees WHERE FirstName LIKE '" . $name ."') ORDER BY ManagerSSN";
			jsonR($link, $sql);
			
		}
		if($searchval == 2)
		{
			$sql = "SELECT * FROM `store` as S INNER JOIN `order` as O ON S.StoreID = O.StoreID INNER JOIN `orderitems` as I ON O.OrderNum = I.OrderID";
			jsonR($link, $sql);
			
		}
		if($searchval == 3)
		{
			$sql = "SELECT ProductID, Department, Name, Price, Qty, Season, Brand, Color, SupplierID FROM products";
			jsonR($link, $sql);
			
		}
		if($searchval == 4)
		{
			$sql = "SELECT ProductID, Department, Name, Price, Qty, Season, Brand, Color, SupplierID FROM products WHERE Department LIKE 'Food'";
			jsonR($link, $sql);
			
		}
		if($searchval == 5)
		{
			$sql = "(SELECT E.LastName, E.FirstName, W.WarehouseID, W.Address FROM employees AS E LEFT JOIN warehouse as W ON W.ManagerSSN = E.SSN)
UNION
(SELECT E.LastName, E.FirstName, W.WarehouseID, W.Address FROM employees as E RIGHT JOIN warehouse as W on W.ManagerSSN = E.SSN)
";
			jsonR($link, $sql);
			
		}
		if($searchval == 6)
		{
			$date = $_POST['date'];
			$sql = "SELECT `Name`, `StoreID`, `Address` FROM store AS S WHERE S.StoreID = ANY (SELECT StoreID FROM `order` AS O WHERE O.RequiredDate = '".$date."')";
			jsonR($link, $sql);
			
		}

	function jsonR($link, $query)
	{
		$result = $link->query($query);
		$rows = array();
		while($ro = mysqli_fetch_assoc($result))
		{
			$rows[]=$ro;
		}
		echo json_encode($rows);
	}

?>