<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link rel="stylesheet" href="/css/login.css">
	    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
</head>
<body class="m-0">
	<div class="xk10xal w-40 mx-auto mt-5 bg-light rounded">
		<div class="xk19310a text-center border-bottom" style="border-color: #000;">
			<p class="m-0 p-1">GeorgiaCB Login-System</p>	
		</div>
		<div class="xkbd102l p-2">
			<form method="POST" action="/login" id="lgsbt3l1al">
			<div class="inpd29kal">
				
				<input type="email" name="email" placeholder="Email..." required class="p-1 m-6 mt-0 no-outline border border-secondary rounded"  id="inpml192l1">
			</div>
				<p class="err1913l">
					<?php if (isset($email_error)) : ?>
						<?php echo htmlspecialchars($email_error); ?>
					<?php endif; ?>
				</p>
			
			<div class="inpd29kal">
				<input type="password" name="password" placeholder="Password..." required class="p-1 m-6 mt-0 no-outline border border-secondary rounded" id="inppas20103">
			</div>
			<p class="errp1913l">
				<?php if (isset($password_error)) : ?>
					<?php echo htmlspecialchars($password_error); ?>
				<?php endif; ?>
			</p>
			<p class="inv1019al">
				<?php if (isset($invalid_credentials)) : ?>
					<?php echo htmlspecialchars($invalid_credentials); ?>
				<?php endif; ?>
			</p>
			<div class="inpd29kal">
				<input type="submit" value="Login">
			</div>
			</form>
			<div class="frg103la">
				<p>Dont have an account? <a href="/register">signup</a></p>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="/js/emlxlask13l1k.js"></script>
	<script>
		clientSideInputValidator.validateInputEmail(document.getElementById('inpml192l1'),document.querySelector('.err1913l'),'Email',5,255);
clientSideInputValidator.validateInputLength(document.getElementById('inppas20103'),document.querySelector('.errp1913l'),'Password',8,255);
	</script>
</body>
</html>