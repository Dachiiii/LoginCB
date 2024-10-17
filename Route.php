<?php

#[Attribute]
final class Route {
	public string $path;
	public string $method;

	public function __construct(string $path, string $method) {
		$this->path = $path;
		$this->method = $method;
	}
}

#[Attribute]
final class AuthenticationRequired {

	public bool $authentication_requierd;

	public function __construct(bool $required = false) {
		$this->authentication_requierd = $required;
	}
}

#[Attribute]
final class OnlyForUnauthenticatedUsers {
	public bool $only_for_unauthenticated_users;
	public function __construct(bool $only_for_unauthenticated_users = true) {
		$this->only_for_unauthenticated_users = $only_for_unauthenticated_users;
	}
} 

final class Router {

	public function route(string $requestUri, string $requestMethod) {
		$controller = new Home();
		$reflectionClass = new ReflectionClass($controller);
		foreach ($reflectionClass->getMethods() as $method) {
			$routeAttributes = $method->getAttributes(Route::class);
			foreach ($routeAttributes as $attribute) {
				$routeInstance = $attribute->newInstance();
				if ($routeInstance->path === $requestUri && $requestMethod === $routeInstance->method) {	
					$this->handleOnlyForUnauthenticatedUsers($method);	
					$this->handleAuthenticationRequired($method);
					$template = $method->invoke($controller, $method);
					if ($template)
						return $template->resolve_template();
					return;
				}

			}
		}
		http_response_code(404);
		return (new Template('404.php'))->resolve_template();
	}

	private function handleAuthenticationRequired(ReflectionMethod $method) {
		$authenticationAttributes = $method->getAttributes(AuthenticationRequired::class);
		foreach ($authenticationAttributes as $attribute) {
			$instance = $attribute->newInstance();
			if ($instance->authentication_requierd === true) {
				if (!$this->isLoggedIn() && $this->isNotLoginPage()) {
					header('Location: /login');
					die();
				}
			}
		}
	}

	private function handleOnlyForUnauthenticatedUsers(ReflectionMethod $method) {
		$authenticationAttributes = $method->getAttributes(OnlyForUnauthenticatedUsers::class);
		foreach ($authenticationAttributes as $attribute) {
			$instance = $attribute->newInstance();
			if ($instance && $instance->only_for_unauthenticated_users === true && $this->isLoggedIn()) {
				header('Location: /');
				die();
			}
		}
	}

	private function isLoggedIn(): bool {
		return isset($_SESSION['is_authenticated']) ? true : false;
	}

	private function isNotLoginPage(): bool {
		return $_SERVER['REQUEST_URI'] !== '/login';
	}
}

?>