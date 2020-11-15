<?php

function getAllItems() {
    global $db;
    $query = "SELECT * FROM item_list";
    $statement = $db->prepare($query);
    $statement->execute();
    $results = $statement->fetchAll(); //array
    $statement->closeCursor();
    return $results;
}

function addItemToAllFoods($itemnameinput, $itemcategoryinput) {
    global $db;
    $addedItem = false;

    try {
        $query = "SELECT * FROM item_list WHERE name=:itemnameinput AND catagory=:itemcategoryinput LIMIT 1;";
        $statement = $db->prepare($query);
        $statement->bindValue(':itemnameinput', $itemnameinput);
        $statement->bindValue(':itemcategoryinput', $itemcategoryinput);
        $statement->execute();
        $results = $statement->fetchAll(); //array
        if (count($results) == 0) {
            $query = "INSERT INTO item_list VALUES(:itemnameinput, :itemcategoryinput, NULL)";
            $statement = $db->prepare($query);
            $statement->bindValue(':itemnameinput', $itemnameinput);
            $statement->bindValue(':itemcategoryinput', $itemcategoryinput);
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


function addItemToInventoryList($username, $itemName) {
  global $db;
  $addedItem = false;

  try {
      $query = "SELECT * FROM home_inventory_list WHERE username=:username AND itemName=:itemName LIMIT 1;";
      //the two will be changed to NULL once we can change the table in phpMyAdmin
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':itemName', $itemName);
      $statement->execute();
      $results = $statement->fetchAll(); //array
      if (count($results) == 0) {
          $query = "INSERT INTO home_inventory_list VALUES(:username, 3, :itemName, 1)";
          //the 2 will be changed to NULL once we can change the table in phpMyAdmin to be AUTO_INCREMENT
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


function addItemToShoppingList($username, $itemName){
  global $db;
  $addedItem = false;

  try {
      $query = "SELECT * FROM shopping_list WHERE username=:username AND itemName=:itemName LIMIT 1;";
      //the two will be changed to NULL once we can change the table in phpMyAdmin
      $statement = $db->prepare($query);
      $statement->bindValue(':username', $username);
      $statement->bindValue(':itemName', $itemName);
      $statement->execute();
      $results = $statement->fetchAll(); //array
      if (count($results) == 0) {
          $query = "INSERT INTO shopping_list VALUES(:username, 1, :itemName, 1, 0)";
          //the 2 will be changed to NULL once we can change the table in phpMyAdmin to be AUTO_INCREMENT
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

function deleteAllFoodsItem($username, $itemName) {
  global $db;
	$query = "DELETE FROM item_list WHERE name=:name";
	$statement = $db->prepare($query);
	$statement->bindValue(':name', $itemName);
	$statement->execute();      // run query
	$statement->closeCursor();  // release hold on this connection
  return true;
}


function getCategory($category) {
    global $db;
    $query = "SELECT * FROM item_list WHERE catagory=:category";
    $statement = $db->prepare($query);
    $statement->bindValue(':category', $category);
    $statement->execute();
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
}

// function addFriends($name, $major, $year) {
//     global $db;

//     $query = "INSERT INTO friends VALUES(:name, :major, :year)";
//     $statement = $db->prepare($query);
//     $statement->bindValue(':name', $name);
//     $statement->bindValue(':major', $major);
//     $statement->bindValue(':year', $year);
//     $statement->execute();
//     $statement->closeCursor();
// }

// function updateFriend($name, $major, $year)
// {
//     global $db;

//     $query = "UPDATE friends SET major=:major, year=:year WHERE name=:name";
//     $statement = $db->prepare($query);
//     $statement->bindValue(':name', $name);
//     $statement->bindValue(':major', $major);
//     $statement->bindValue(':year', $year);
//     $statement->execute();
//     $statement->closeCursor();
// }

// function deleteFriend($name)
// {
//     global $db;

//     $query = "DELETE FROM friends WHERE name=:name";
//     $statement = $db->prepare($query);
//     $statement->bindValue(':name', $name);
//     $statement->execute();
//     $statement->closeCursor();
// }
// ?>
