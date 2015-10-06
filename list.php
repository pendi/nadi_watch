<?php
if (!empty($_GET['list']) || isset($_GET['list'])) {
	$list = $_GET['list'];
} else {
	$list = "";
}

switch($list)
{
	case "1";
	include "aplikasi/index.php";
	break;
	
		
	case "2";
	include "aplikasi/login_member.php";
	break;
	
	
	case "3";
	include "aplikasi/register_member.php";
	break;
	
	
	case "4";
	include "check.php";
	break;
			
	case "5";
	include "admin/login_admin.php";
	break;
	
	case "6";
	include "admin/dashboard.php";
	break;
	
	case "7";
	include "aplikasi/logout.php";
	break;
	
	
	case "8";
	include "admin/list_product.php";
	break;
	
	
	case "9";
	include "admin/list_admin.php";
	break;
	
	case "10";
	include "admin/add_product.php";
	break;
	
	case "11";
	include "admin/edit_product.php";
	break;
	
	case "12";
	include "admin/delete_product.php";
	break;
	
	case "13";
	include "process/publish_product.php";
	break;
	
	case "14";
	include "admin/register_admin.php";
	break;

	case "15";
	include "admin/delete_admin.php";
	break;

	case "16";
	include "admin/edit_admin.php";
	break;

	case "17";
	include "admin/edit_email.php";
	break;

	case "18";
	include "admin/edit_first_name.php";
	break;

	case "19";
	include "admin/edit_last_name.php";
	break;

	case "20";
	include "admin/edit_password.php";
	break;

	case "21";
	include "aplikasi/purchase.php";
	break;

	case "22";
	include "aplikasi/data_customer.php";
	break;

	case "23";
	include "aplikasi/summary.php";
	break;

	case "24";
	include "aplikasi/detail.php";
	break;

	case "25";
	include "admin/list_vendor.php";
	break;

	case "26";
	include "admin/add_vendor.php";
	break;

	case "27";
	include "admin/edit_vendor.php";
	break;

	case "28";
	include "admin/delete_vendor.php";
	break;

	case "29";
	include "admin/transaction.php";
	break;

	case "30";
	include "aplikasi/product.php";
	break;

	case "31";
	include "aplikasi/order.php";
	break;

	case "32";
	include "aplikasi/edit_member.php";
	break;

	default;
	include "aplikasi/index.php";
	break;
}

?>