
<?php


final class Home {

	#[Route('/','GET')]
	#[AuthenticationRequired(true)]
	public function index() : Template {
		return new Template('home.php');
	}

	#[Route('/login','GET')]
	#[OnlyForUnauthenticatedUsers(true)]
	public function login(): Template {
		return new Template('login.php');
	}

	#[Route('/login','POST')]
	#[OnlyForUnauthenticatedUsers(true)]
	public function processLogin(): Template|null {
		$submited_data = $_POST;
		$excepted_arguments = ['email', 'password'];
		if (Validate::IsValidArguments($excepted_arguments, $submited_data)) {
			$email = $submited_data['email'];
			$password = $submited_data['password'];
			$validate_email_length = Validate::isValidLength('email', $email,5,255);
			$validate_password_length = Validate::isValidLength('password',$password,8,255);

			if ($validate_email_length === true && $validate_password_length === true) {
				$db = new DB();
				$sql = "SELECT * FROM users WHERE email = :email";
				$params = ['email' => $email];
				$db->query($sql, $params);
				$user = $db->fetch();
				if ($user && (password_verify($password, $user['password']))) {
					$_SESSION['is_authenticated'] = true;
					return header('Location: /');
					die();
				} else
					$errors['invalid_credentials'] = 'Invalid Credentials';
					return new Template('login.php',$errors);
				
			} else {
				$errors = Validate::GetErrorsForInvalidInput($validate_email_length, $validate_password_length);
				return new Template('login.php', $errors);
			}
		} else
			$errors = Validate::GetErrorsForMissingArguments($excepted_arguments, $submited_data);
	
		if (!empty($errors)) 
			return new Template('login.php', $errors);
	
		return new Template('login.php');
	}

	#[Route('/register','GET')]
	#[OnlyForUnauthenticatedUsers(true)]
	public function Register(): Template {
		return new Template('register.php');
	}

	#[Route('/register','POST')]
	#[OnlyForUnauthenticatedUsers(true)]
	public function ProcessRegister() {
		$submited_data = $_POST;
		$excepted_arguments = ['email', 'password', 'confirm_password'];
		if (Validate::IsValidArguments($excepted_arguments, $submited_data)) {
			if (!Validate::ValidateConfirmedPassword($submited_data['password'], $submited_data['confirm_password'])) {
				$errors['passwords_mismatch'] = 'Passwords Mismatch';
			} else {
				$email = $submited_data['email'];
				$password = $submited_data['password'];
				$confirmed_password = $submited_data['confirm_password'];
				$validate_email_length = Validate::isValidLength('email', $email,5,255);
				$validate_password_length = Validate::isValidLength('password',$password,8,255);
				$validate_confirmed_password_length = Validate::isValidLength('confirm_password',$confirmed_password,8,255);

				if ($validate_email_length === true && $validate_password_length === true && $validate_confirmed_password_length === true) { 
					$db = new DB();
					$sql = "SELECT * FROM users WHERE email = :email";
					$db->query($sql, ['email'=>$submited_data['email']]);
					$user = $db->fetch();
					if ($user) {
						$errors['email_error'] = 'Email is already registerd';
						return new Template('register.php', $errors);
					} else {
						$sql = "INSERT INTO users (email,password) VALUES (:email, :password)";
						$hashed_password = password_hash($submited_data['password'], PASSWORD_BCRYPT);
						$params = [
							'email' => $submited_data['email'],
							'password' => $hashed_password,
						];
						$db->query($sql, $params);
					}
				} else {
					$errors = Validate::GetErrorsForInvalidInput($validate_email_length, $validate_password_length, $validate_confirmed_password_length);
					return new Template('register.php',$errors);
				}
			}
			
		} else 
			$errors = Validate::GetErrorsForMissingArguments($excepted_arguments, $submited_data);
		
		if (isset($errors))
			return new Template('register.php', $errors);
		
		header('Location: /login');
		die();
	}

}
?>