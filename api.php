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
			$sql = "SELECT E.FirstName, E.LastName, E.Sex, E.WarehouseID FROM `employees` as E, `warehouse` as W WHERE E.WarehouseID = W.WarehouseID AND W.Address LIKE '" . $name ."'";
			jsonR($link, $sql);
			
		}
		if($searchval == 2)
		{
			$sql = "SELECT S.StoreID, S.Address, S.Name FROM `store` as S INNER JOIN `order` as O ON S.StoreID = O.StoreID INNER JOIN `orderitems` as I ON O.OrderNum = I.OrderID";
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
			$date = $_GET['date'];
			$sql = "SELECT `StoreID`, `Name`, `Address` FROM store AS S WHERE S.StoreID = ANY (SELECT StoreID FROM `order` AS O WHERE O.RequiredDate = '".$date."' ORDER BY S.StoreID DESC)";
			jsonR($link, $sql);
			
		}

		if($searchval == 7)
		{
			$sql = "SELECT * FROM store as S WHERE NOT EXISTS( SELECT 1 FROM `order` AS O WHERE O.StoreID = S.StoreID)";
			jsonR($link, $sql);
			
		}
		if($searchval == 8)
		{
			$shade = $_GET['color'];
			$sql = "SELECT Department, Name, Price, Qty, Season, Brand FROM `products` WHERE `Color` LIKE '".$shade."'";
			jsonR($link, $sql);
		}
		if($searchval == 9)
		{
			$sql = "SELECT * FROM store WHERE Discount != 1.0";
			jsonR($link, $sql);
		}
		if($searchval == 10)
		{
			$name = $_GET['sname'];
			$sql = "SELECT S.Name, SUM(OI.Price) as 'Total($)' FROM `store` as S, `orderitems` as OI, `order` as O WHERE S.StoreID = O.StoreID AND O.OrderNum = OI.OrderID AND S.Name = '".$name."' GROUP BY S.Name";
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
		if(empty($rows))
		{
			$g = array([]);
			echo json_encode($g);
		}
		else
		{
		echo json_encode($rows);
		}
	}

?>
