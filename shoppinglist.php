<?php
require ('connectdb.php');
require ('shoppinglist_db_functions.php');

session_start();

if(!isset($_SESSION['username'])) {
     header("Location: login.php"); //Change for Google Cloud
}
//session has started sucessfully
else {   

    $items = getAllitems();
    $notification = 'Successfully added to Shopping List!';
    $showNotification = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //log out of page
        if (!empty($_POST['logout']) && $_POST['logout'] == 'Log out') {
            session_destroy();
            header("Location: login.php");
        }
        //edit shopping list item
        elseif (!empty($_POST['updateItem']) && ($_POST['addItem'] == 'Update item in Shopping List')) {      
            $itemnameinput = $_POST['itemnameinput']; 
            $itemcategoryinput = $_POST['itemcategoryinput'];  
            
            if (updateItemInShoppingList($username, $itemName)) {
                $notification = 'Successfully updated item in Shopping List!';
                $items = getAllItems();  
            } else {
                $notification = 'Unable to update item.';
            }
            $showNotification = true;
        }
        //add item to inventory list
        elseif (!empty($_POST['add_inventory']) && ($_POST['add_inventory'] == 'Add')){
          $username = $_SESSION['username'];
          $itemName = $_POST['item_to_add_inventory'];

          if(addItemToInventoryList($username, $itemName)){
            $notification = 'Successfully added item to Inventory List!';
            $items = getAllItems();
          } else{
            $notification = 'Item already exists in inventory list.';
          }
          $showNotification = true;
        }
        //delete item from Shopping List
        elseif (!empty($_POST['deleteItem']) && ($_POST['deleteItem'] == 'Delete')) {
          $username = $_SESSION['username'];
          $itemName = $_POST['item_to_delete'];
          if(deleteAllFoodsItem($username, $itemName)){
            $notification = 'Successfully deleted item from the list!';
            $items = getAllItems();
          } else{
            $notification = 'Item could not be deleted.';
          }
          $showNotification = true;
        }
    }
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Elliot Murdock">
    <meta name="description" content="Home page for the GrocerEase app">
    <title>GrocerEase - Know your foods</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="styles.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
    <nav class="navbar bg-light topnav">
        <a href="home.php" class="navbar-brand"><img src="logowide.png" height="35" /></a>

        <form class="form-inline" name="logoutForm" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <span class="navbar-text" id="usernamedisplay">
                Welcome <?php echo $_SESSION['username'] ?>
            </span>
            <span>
                <input id="logoutbutton" type="submit" value="Log out" name="logout"
                    class="btn logoutbutton addbutton" />
            </span>
        </form>
    </nav>
    <div class="w3-sidebar w3-bar-block" id="sidebar">
        <a href="home.php" class="w3-bar-item w3-button sidenavbutton">All Foods</a>
        <a href="inventory.php" class="w3-bar-item w3-button sidenavbutton">My Inventory</a>
        <a href="shoppinglist.php" class="w3-bar-item w3-button sidenavbutton active">My Shopping List</a>
    </div>
    <div id="tablecontainer">
        <h1>Update item</h1>
        <form name="updateItemForm" class="form-inline" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            <label for="itemnameinput" class="form-inline-item-15">Item name:</label>
            <input type="text" name="itemnameinput" class="form-inline-item-30">
            <input type="submit" value="Update item in Shopping List" name="updateItem" class="btn addbutton" />
            <div id="snackbar"><?php echo $notification ?></div>
        </form>
        <hr>
        </hr>
        <h1>Shopping List</h1>
        <table class="w3-table w3-bordered w3-card-4">
            <thead>
                <tr class="tableheadrow">
                    <th width="20%">Item</th>
                    <th width="20%">Quantity</th>
                    <th width="20%">Bought</th>
                    <th width="25%">Add to My Inventory</th>
                    <th width="5%">Delete</th>
                </tr>
            </thead>
            <?php foreach ($items as $item): ?>
            <tr>
                <td>
                    <?php echo $item['itemName']; ?>
                </td>
                <td>
                    <div class="form-inline">
                        <?php echo $item['quantity']; ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                            <input type="submit" value="+1" name="add_inventory" class="btn plusbutton"
                                title="Update the record" />
                            <input type="hidden" name="item_to_update" value="name_of_item_to_update" />
                        </form>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

                            <input type="submit" value="-1" name="add_inventory" class="btn minusbutton"
                                title="Update the record" />
                            <input type="hidden" name="item_to_update" value="name_of_item_to_update" />
                        </form>
                    </div>
                </td>
                <td>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <?php echo $item['bought']; ?>
                        <input type="submit" value="Add" name="add_inventory" class="btn addbutton"
                            title="Update the record" />
                        <input type="hidden" name="item_to_update" value="name_of_item_to_update" />
                    </form>
                </td>
                <td>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="submit" value="Add" name="add_inventory" class="btn addbutton"
                            title="Update the record" />
                        <input type="hidden" name="item_to_update" value="item_to_add_inventory" />
                    </form>
                </td>
                <td>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="submit" value="Delete" name="deleteItem" class="btn btn-danger"
                            title="Permanently delete the record" />
                        <input type="hidden" name="item_to_delete" value="<?php echo $item['name'] ?>" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <script>
    function showNotification() {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function() {
            x.className = x.className.replace("show", "");
        }, 3000);
    }
    </script>
</body>

</html>

<?php 
if ($showNotification) {
    echo 
    '<script 
        type="text/javascript">
        showNotification(); 
    </script>';
    $showNotification = false;
} 
?>

<?php } ?>