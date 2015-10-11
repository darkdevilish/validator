# Validator by Anthony Gonzalez

Validator is an easy, simple, fast an reliable way of validating input with php.

It will store an array with each error found.

### Validate that input is not empty

It takes an associative array of values with name as key, if found that value is empty it will store the name of value capitalize can't be blank error in the errors array:

```php
$values = array('name' => 'John', 'username' => 'chacala');
Validator::validate_presences($values);
```

### Validate that input is a valid email address

It takes an associative array of value of email and name as key, if invalid it will add name of value capitalize address (email) is invalid to errors array:

```php
$email = array('email' => "john@doe.com");
Validator::validate_email($email);
```

### Validate length of input

It takes 2 parameter both associative arrays, one with the name of input and options, and the other one with name of input and value, thera are 3 options max, min, exact or both max and min. If found errors it will store in the errors array the following: name of input is too short (number characters minimum), name of input is too long (number characters maximum), name of input does not match number characters. Example usage:

```php
$fields_with_options = array(
  'name' => array('max' => 3, 'min' => 10), 
  'username' => array('min' => 5),
  'last-name' => array('exact' => 5),
);
$values = array(
  'name' => "John", 
  'username' => "john", 
  'last-name' => 'Doe',
);
Validator::validate_lengths($fields_with_options, $values); 
```

### To get errors (it will return false if empty)

```php
Validator::errors();
```

[NOTE: if input name has more than one word separate them with hiphen.]
