<?php 

function getAllItems() {
    global $db;
    $query = "SELECT * FROM shopping_list";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(); //array
    $statement->closeCursor();  
    return $results;
}

function addItemToInventoryList($username, $itemName) {
  global $db;
  $addedItem = false;

  try {
      $query = "SELECT * FROM home_inventory_list WHERE username=:username AND itemName=:itemName LIMIT 1;";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':itemName', $itemName);
      $statement->execute();
      $results = $statement->fetchAll(); //array
      if (count($results) == 0) {
          $query = "INSERT INTO home_inventory_list VALUES(:username, :itemName, 1, NULL)";
          $statement = $db->prepare($query);
          $statement->bindValue(':username', $username);
          $statement->bindValue(':itemName', $itemName);
          $statement->execute();
          $statement->closeCursor();
          $addedItem = true;
      }
  }
  catch (Exception $e) {
      $error_message = $e->getMessage();
      echo "<p>Error message: $error_message </p>";
  }
  return $addedItem;
}

function updateItemQuantity($username, $itemName, $quantity, $subtract) {
  global $db;
  $updatedQuantity = false;

  if ($subtract && $quantity < 0) {
    return true;
  }

  try {
      $query = "SELECT * FROM shopping_list WHERE username=:username AND itemName=:itemName LIMIT 1;";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':itemName', $itemName);
      $statement->execute();
      $results = $statement->fetchAll(); //array
      if (count($results) == 0) {
          $query = "UPDATE shopping_list SET =:quantity WHERE username=:username AND itemName=:itemName LIMIT 1;";
          $statement = $db->prepare($query);
          $statement->bindValue(':username', $username);
          $statement->bindValue(':itemName', $itemName);
          $statement->execute();
          $statement->closeCursor();
          $addedItem = true;
      }
    }
    catch (Exception $e) {
        $error_message = $e->getMessage();
        echo "<p>Error message: $error_message </p>";
    }
    return $addedItem;
}

$query = "UPDATE friends SET major=:major, year=:year WHERE name=:name";
$statement = $db->prepare($query);
$statement->bindValue(':name', $name);
$statement->bindValue(':major', $major);
$statement->bindValue(':year', $year);
$statement->execute();
$statement->closeCursor();    

function deleteShoppingListItem($username, $itemName) {
  global $db;
	$query = "DELETE FROM item_list WHERE name=:name";
	$statement = $db->prepare($query);
	$statement->bindValue(':name', $itemName);
	$statement->execute();      // run query
	$statement->closeCursor();  // release hold on this connection
  return true;
}