
class clientSideInputValidator {
	/*
	This is client side validation and can be bypassed easily. its just for a UX/UI and to help users login/signup.
	*/
	static validateInputLength(inputDOM, errorMessageDOM, DisplayFieldName, minLength, maxLength) {
		inputDOM.addEventListener('input', function() {
			clientSideInputValidator.displayErrorMessage(inputDOM, errorMessageDOM, maxLength, minLength, DisplayFieldName);
		})
	}

	static validateInputEmail(inputDOM, errorMessageDOM, DisplayFieldName, minLength, maxLength) {
		const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
		inputDOM.addEventListener('input', function() {
			if (!emailPattern.test(inputDOM.value))
				errorMessageDOM.textContent = `${DisplayFieldName} is invalid`;
			else
				errorMessageDOM.textContent = '';
		})
	}

	static displayErrorMessage(inputDOM, errorMessageDOM, maxLength, minLength, DisplayFieldName) {
		length = this.getInputValueLength(inputDOM);
		if (length < minLength)
			errorMessageDOM.textContent = `${DisplayFieldName} is too short`;
		else if (length > maxLength)
			errorMessageDOM.textContent = `${DisplayFieldName} is too long`;
		else 
			errorMessageDOM.textContent = '';
	}

	static getAllActiveErrorMessage() {
		const error_ids = ['.err1913l','.errp1913l','.errrp1913l'];
		let pass = 0;
		for (let i = 0; i < error_ids.length; i++) 
			if (document.querySelector(error_ids[i]).innerText === '')
				pass += 1;
			
		return (pass===error_ids.length) ? true : false;

	}

	static getInputValueLength(inputDOM) {
		return inputDOM.value.length;
	}

	static passwordMatchValidation(password1DOM, password2DOM, errorDOM) {
		password1DOM.addEventListener('input', () => this.match(password1DOM,password2DOM, errorDOM));
		password2DOM.addEventListener('input', () => this.match(password1DOM,password2DOM, errorDOM));
	}

	static match(password1DOM, password2DOM, errorDOM) {
		if ((password1DOM.value.length > 0 && password2DOM.value.length > 0) && password1DOM.value===password2DOM.value){
			errorDOM.textContent = '';
		} else {
			if (errorDOM.innerText === '') {
				errorDOM.textContent = 'Passwords Mismatch';
			}
		}
	}

	static validateSubmit(formDOM) {
		formDOM.addEventListener('submit', function(event) {
			let errors_not_exists = clientSideInputValidator.getAllActiveErrorMessage();
			if (!errors_not_exists)
				event.preventDefault();
		})
	}
}

