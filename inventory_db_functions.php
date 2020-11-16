<?php

function getAllItemsInventoryList($username) {
    global $db;
    $query = "SELECT * FROM home_inventory_list WHERE username=:username;";
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $results = $statement->fetchAll(); //array
    $statement->closeCursor();
    return $results;
}

function addItemToShoppingList($username, $itemName) {
  global $db;
  $addedItem = false;

  try {
      $query = "SELECT * FROM shopping_list WHERE username=:username AND itemName=:itemName LIMIT 1;";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':itemName', $itemName);
      $statement->execute();
      $results = $statement->fetchAll(); //array
      if (count($results) == 0) {
          $query = "INSERT INTO shopping_list VALUES(:username, :itemName, 1, 0, NULL)";
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
      $query = "SELECT * FROM home_inventory_list WHERE username=:username AND itemName=:itemName LIMIT 1;";
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':itemName', $itemName);
      $statement->execute();
      $results = $statement->fetchAll(); //array
      if (count($results) != 0) {
          $query = "UPDATE home_inventory_list SET remaining=:remaining WHERE username=:username AND itemName=:itemName LIMIT 1;";
          $statement = $db->prepare($query);
          $statement->bindValue(':username', $username);
          $statement->bindValue(':itemName', $itemName);
          $statement->bindValue(':remaining', $quantity);
          $statement->execute();
          $statement->closeCursor();
          $updatedQuantity = true;
      }
    }
    catch (Exception $e) {
        $error_message = $e->getMessage();
        echo "<p>Error message: $error_message </p>";
    }
    return $updatedQuantity;
}

function callFixInventory() {
  global $db;

  try {
      $query = "CALL fixInventory();";
      $statement = $db->prepare($query);
      $statement->execute();
  }
  catch (Exception $e) {
        $error_message = $e->getMessage();
        echo "<p>Error message: $error_message </p>";
  }
}

function deleteInventoryListItem($username, $itemName) {
  global $db;
	$query = "DELETE FROM home_inventory_list WHERE itemName=:itemName AND username=:username";
	$statement = $db->prepare($query);
	$statement->bindValue(':itemName', $itemName);
  $statement->bindValue(':username', $username);
	$statement->execute();      // run query
	$statement->closeCursor();  // release hold on this connection
  return true;
}