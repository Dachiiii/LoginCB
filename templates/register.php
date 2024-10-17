<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="/css/login.css">
</head>
<body>
	<div class="xk10xal">
		<div class="xk19310a">
			<p>Register | GeorgiaCB</p>	
		</div>
		<div class="xkbd102l">
			<form method="POST" action="/register" id="sbt3l1al">
			<div class="inpd29kal">
				
				<input type="email" name="email" placeholder="Email..." id="inpml192l1">
			</div>
				<p class="err1913l">
					<?php if (isset($email_error)) : ?>
						<?php echo htmlspecialchars($email_error); ?>
					<?php endif; ?>
				</p>
			
			<div class="inpd29kal">
				<input type="Password" name="password" placeholder="Password..." required id="inppas20103">
			</div>
			<p class="errp1913l">
				<?php if (isset($password_error)) : ?>
					<?php echo htmlspecialchars($password_error); ?>
				<?php endif; ?>
			</p>
			<div class="inpd29kal">
				<input type="Password" name="confirm_password" placeholder="Confirm Password..." required id="inppasrp20103">
			</div>
			<p class="errrp1913l">
				<?php if (isset($confirm_password_error)) : ?>
					<?php echo htmlspecialchars($confirm_password_error); ?>
				<?php endif; ?>
			</p>
			<p class="err1913l">
				<?php if (isset($passwords_mismatch)) : ?>
					<?php echo htmlspecialchars($passwords_mismatch); ?>
				<?php endif; ?>
			</p>
			<div class="inpd29kal">
				<input type="submit" value="Register" id="r103lak19">
			</div>
			</form>
			<div class="frg103la">
				<p>Already have an Account? <a href="/login">login</a></p>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/js/emlxlask13l1k.js"></script>
	<script type="text/javascript" src="/js/rgs1l3kal.js"></script>
</body>
</html>