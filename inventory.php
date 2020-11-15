<?php
require ('connectdb.php');
require ('inventory_db_functions.php');

session_start();

if(!isset($_SESSION['username'])) {
     header("Location: login.php"); //Change for Google Cloud
}
//session has started sucessfully
else {
    $items = getAllItemsInventoryList($_SESSION['username']);
    $notification = '';
    $showNotification = false;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //log out of page
        if (!empty($_POST['logout']) && $_POST['logout'] == 'Log out') {
            session_destroy();
            header("Location: login.php");
        }
        // subtract quantity from an item
        elseif (!empty($_POST['subtract_quantity']) && ($_POST['subtract_quantity'] == '-')) {
            $username = $_SESSION['username'];
            $itemName = $_POST['item_name_quantity_subtracted'];
            $quantity = $_POST['item_quantity_subtracted'];

            if ($quantity < 0) {
                $quantity = 0;
            }

            if (updateItemQuantity($username, $itemName, $quantity, true)) {
                $items = getAllItemsInventoryList($_SESSION['username']);
            }
        }
        // add quantity to an item
        elseif (!empty($_POST['add_quantity']) && ($_POST['add_quantity'] == '+')) {
            $username = $_SESSION['username'];
            $itemName = $_POST['item_name_quantity_added'];
            $quantity = $_POST['item_quantity_added'];

            if (updateItemQuantity($username, $itemName, $quantity, true)) {
                $items = getAllItemsInventoryList($_SESSION['username']);
            }
        }
        //add item to inventory list
        elseif (!empty($_POST['add_shoppingList']) && ($_POST['add_shoppingList'] == 'Add')){
            $username = $_SESSION['username'];
            $itemName = $_POST['item_name_inventory_list'];

            if(addItemToShoppingList($username, $itemName)){
              $notification = 'Successfully added item to Shopping List!';
              $items = getAllItemsInventoryList($_SESSION['username']);
            } else{
              $notification = 'Item already exists in Shopping List.';
            }
            $showNotification = true;
          }
        //delete item from Shopping List
        elseif (!empty($_POST['deleteItem']) && ($_POST['deleteItem'] == 'Delete')) {
          $username = $_SESSION['username'];
          $itemName = $_POST['item_to_delete'];

          if (deleteInventoryListItem($username, $itemName)){
            $notification = 'Successfully deleted item from Inventory List!';
            $items = getAllItemsInventoryList($_SESSION['username']);
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
        <a href="inventory.php" class="w3-bar-item w3-button sidenavbutton active">My Inventory</a>
        <a href="shoppinglist.php" class="w3-bar-item w3-button sidenavbutton ">My Shopping List</a>
    </div>
    <div id="tablecontainer">
        <div class="form-inline">
            <h1>Inventory List</h1>
            <div id="snackbar"><?php echo $notification ?></div>
        </div>
        <table class="w3-table w3-bordered w3-card-4">
            <thead>
                <tr class="tableheadrow">
                    <th width="25%">Item</th>
                    <th width="25%">Remaining</th>
                    <th width="25%">Add to Shopping List</th>
                    <th width="25%">Delete</th>
                </tr>
            </thead>
            <?php foreach ($items as $item): ?>
            <tr>
                <td>
                    <?php echo $item['itemName']; ?>
                </td>
                <td>
                    <div class="form-inline">
                        <?php echo $item['remaining']; ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="submit" value="+" name="add_quantity" class="btn plusbutton" />
                            <input type="hidden" name="item_name_quantity_added"
                                value="<?php echo $item['itemName'] ?>" />
                            <input type="hidden" name="item_quantity_added" value=<?php echo $item['remaining'] + 1?> />

                        </form>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                            <input type="submit" value="-" name="subtract_quantity" class="btn minusbutton" />
                            <input type="hidden" name="item_name_quantity_subtracted"
                                value="<?php echo $item['itemName'] ?>" />
                            <input type="hidden" name="item_quantity_subtracted"
                                value="<?php echo $item['remaining'] - 1 ?>" />
                        </form>
                    </div>
                </td>
                <td>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="submit" value="Add" name="add_shoppingList" class="btn addbutton" />
                        <input type="hidden" name="item_name_inventory_list" value="<?php echo $item['itemName'] ?>" />
                    </form>
                </td>
                <td>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                        <input type="submit" value="Delete" name="deleteItem" class="btn deletebutton"
                            title="Permanently delete the record" />
                        <input type="hidden" name="item_to_delete" value="<?php echo $item['itemName'] ?>" />
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
