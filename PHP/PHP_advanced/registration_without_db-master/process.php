<?php
	session_start();

	//var_dump($_POST);

	if(isset($_POST["action"]) && $_POST["action"] == "registration")
	{
		$errors = array();
		$errors_textfield_style = array();

		if(empty($_POST["email"]))
		{
			$errors[] = "Email is required!";
			$errors_textfield_style[] = "input.email{ outline: 1px solid red }";
		}
		else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
		{
			$errors[] = "Please provide a valid email!";
			$errors_textfield_style[] = "input.email{ outline: 1px solid red }";
		}

		if(empty($_POST["first_name"]))
		{
			$errors[] = "First name is required!";
			$errors_textfield_style[] = "input.firstname{ outline: 1px solid red }";
		}
		else if(preg_match("/[0-9]/", $_POST["first_name"]))
		{
			$errors[] = "Please provide a proper first name!";
			$errors_textfield_style[] = "input.firstname{ outline: 1px solid red }";
		}

		if(empty($_POST["last_name"]))
		{
			$errors[] = "Last name is required!";
			$errors_textfield_style[] = "input.lastname{ outline: 1px solid red }";
		}
		else if(preg_match("/[0-9]/", $_POST["last_name"]))
		{
			$errors[] = "Please provide a proper last name!";
			$errors_textfield_style[] = "input.lastname{ outline: 1px solid red }";
		}

		if(empty($_POST["password"]))
		{
			$errors[] = "Password is required!";
			$errors_textfield_style[] = "input.password{ outline: 1px solid red }";
		}
		else if(strlen($_POST["password"]) < 7)
		{
			$errors[] = "Please provide a password that has more than 6 characters!";
			$errors_textfield_style[] = "input.password{ outline: 1px solid red }";
		}

		if(empty($_POST["c_password"]))
		{
			$errors[] = "Please confirm password!";
			$errors_textfield_style[] = "input.cpassword{ outline: 1px solid red }";
		}
		else if($_POST["password"] != $_POST["c_password"])
		{
			$errors[] = "Please provide a matching password!";
			$errors_textfield_style[] = "input.cpassword{ outline: 1px solid red }";
		}

		if(!empty($_POST["birthdate"]))
		{
			$birth_date_arr = explode("/", $_POST["birthdate"]);
			if(count($birth_date_arr) == 3 && !preg_match("/[a-zA-Z]/", $_POST["birthdate"]))
			{
				if(!checkdate($birth_date_arr[0], $birth_date_arr[1], $birth_date_arr[2]))
				{
					$errors[] = "Please provide a valid date!";
					$errors_textfield_style[] = "input.birthdate{ outline: 1px solid red }";
				}
			}
			else
			{
				$errors[] = "Please provide the correct date format!";
				$errors_textfield_style[] = "input.birthdate{ outline: 1px solid red }";
			}
		}

		if(isset($_FILES))
		{
			$uploads_dir = getcwd() . "/upload";
    		if($_FILES["profilepic"]["error"] == UPLOAD_ERR_OK)
    		{
        	$tmp_name = $_FILES["profilepic"]["tmp_name"];
        	$name = $_FILES["profilepic"]["name"];
        	move_uploaded_file($tmp_name, "$uploads_dir/$name");
    		}
		}
		

		if(count($errors) > 0)
		{
			$_SESSION["errors"] = $errors;
			$_SESSION["errors_textfield_style"] = $errors_textfield_style;
			$_SESSION["success"] = "";
		}
		else
		{
			$_SESSION["errors"] = array();
			$_SESSION["errors_textfield_style"] = array();
			$_SESSION["success"] = "Thanks for submitting your information.";
		}
	}

	header("Location: index.php");
?>