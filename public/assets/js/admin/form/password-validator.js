/**
 * Must contain list item with this id:
 * 1. password_contain_uppercase for must has uppercase rules
 * 2. password_contain_lowercase for must has lowercase rules
 * 3. password_contain_number for must has number rules
 * 4. password_contain_char for must has char rules
 */

const UPPERCASE_REGEX = /[A-Z]/;
const LOWERCASE_REGEX = /[a-z]/;
const NUMBER_REGEX = /\d/;
const CHAR_REGEX = /[!~@#\$%\^&\*\(\)_\+={}\[\]\\|:;"'<,>\./?]/;

function validatePasswordValue(password) {
    const IS_CONTAIN_UPPERCASE = UPPERCASE_REGEX.test(password);
    const IS_CONTAIN_LOWERCASE = LOWERCASE_REGEX.test(password);
    const IS_CONTAIN_NUMBER = NUMBER_REGEX.test(password);
    const IS_CONTAIN_CHAR = CHAR_REGEX.test(password);

    $('#password_contain_uppercase').toggleClass('invalid_password', !IS_CONTAIN_UPPERCASE);
    $('#password_contain_lowercase').toggleClass('invalid_password', !IS_CONTAIN_LOWERCASE);
    $('#password_contain_number').toggleClass('invalid_password', !IS_CONTAIN_NUMBER);
    $('#password_contain_char').toggleClass('invalid_password', !IS_CONTAIN_CHAR);

    const IS_ALL_COMPLETED = IS_CONTAIN_UPPERCASE && IS_CONTAIN_LOWERCASE && IS_CONTAIN_NUMBER && IS_CONTAIN_CHAR;

    return IS_ALL_COMPLETED;
}
