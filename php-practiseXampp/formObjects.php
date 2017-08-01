<?php
//load the class
require 'form.php';

/*
Instantiate a form object
$form = new Form();
var_dump($form);

echo PHP_EOL;

Instantiates another form object 
$anotherForm = new Form();
var_dump($anotherForm);

echo PHP_EOL;

Verify data type
echo gettype($form);

$attributes = [
    'nameAttribute' => 'Registration',
    'classAttribute' => 'FormClass1',
];

$id = 'FormId';

$form = new Form();
$form->setFormAttribs($attributes);
$form->setId($id);

$form = new Form();
$name = 'LoginForm';
$id = 'FormA';

$form->setName($name)->setId($id); // example of method chaining. '$form->setName($name)' comes first, returns $this = $form for the second part '->setId($id);' to continue.
*/


$name = 'Login';
$id = 'Form1';
$loginForm = new Form($name, $id);

$name = 'Register';
$id = 'Form2';
$registerForm = new Form($name, $id);

echo $loginForm->getName().'<br>';
echo $registerForm->getName().'<br>';
// ^ 2 forms are made using the same class, but each form is passing different
// name and id variables. The constructer uses these to make each of the objects unquie.

$type = 'text';
$name = 'username';
$fields[] = new Field($type, $name);
//^ uses 2nd class Field

$name = 'password';
$fields[] =  new Field($type, $name);
//^ makes another object using Field class.

$name = 'Login';
$id = 'Form1';
$form = new Form($name, $id, $fields);
// now makes a new form Object using the form class which now has 2 objects in the fields array to use.

//output 
echo $form->getStartTag().' ';
foreach($form->getFields() as $field) {
    echo ucfirst($field->getName()).': '.$field->getTag().' ';
}
echo $form-getEndTag();
/*Note my code has errors should display;

<form name="Login" id="Form1">
    Username: <input type="text" name="username">
    Password: <input type="text" name="password">
</form>

#becomes a real html displayed form.

*/

$total = 125;

echo Utility::formatCurrency($total);

//^ makes use of the class with static property and method;
// NOTE IT DOESN'T NEED TO BECOME AN OBJECT, class is being used.

?>