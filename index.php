<?php
switch (@parse_url($_SERVER['REQUEST_URI'])['path']) {
   case '/':                   // URL (without file name) to a default screen
		require 'login.php';
		require ('connectdb.php');
		require ('login_db_functions.php');
		break; 
	case '/login.php':                  
		require 'login.php';
		require ('connectdb.php');
		require ('login_db_functions.php');
		break; 
   case '/home.php':     // if you plan to also allow a URL with the file name 
		require 'home.php';
		require ('home_db_functions.php');
		require ('connectdb.php');
		break;              
   case '/shoppinglist.php':
		require 'shoppinglist.php';
		require ('connectdb.php');
		require ('shoppinglist_db_functions.php');
		break;
	case '/inventory.php':
		require 'inventory.php';
		require ('connectdb.php');
		require ('inventory_db_functions.php');
		break;
	case '/signup.php':
		require 'signup.php';
		require ('connectdb.php');
		require ('signup_db_functions.php');
		break;
   default:
      http_response_code(404);
      exit('Not Found');
}  
?>