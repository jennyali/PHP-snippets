<?php
// PLEASE NOTE i've put 3 different chunks of php in this one file'

// 1, Class FORM //

Class Form{
    public $id;
    public $name;
    public $fields = [];

    public function __construct($name, $id, array $fields = null){
        $this->name = $name;
        $this->id = $id;
        $this->fields = $fields;
    }

    public function getStartTag(){
        return "<form id=\"$this->id\" name=\"$this->name\" action=\"index.php\" method=\"post\">";
    }

    public function getFields(){
        return $this->fields;
    }

    public function getEndTag(){
        return '</form>';
    }
}

// 2, Class INPUT field //

class InputText{
    public $type = 'text';
    public $label;
    public $value;
    public $required;

    public function getInput(){
        return "<input type=\"$this->type\" name=\"$this->label\" $this->required/>";
    }

    public function setLabel($label){
        $this->label = ucfirst($label);
    }

    public function setValue($value){
        $this->value = $value;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setRequired(){
        $this->required = 'required';
    }
}

// 3, output the form element using these 2 classes //

// form attributes
$name = 'Login';
$id = 'Form1';

//The username input : note no construction method, uses the setter methods to pass in values
$usernameInput = new InputText();
$usernameInput->setlabel('username');
$usernameInput->setRequired();

//the password input 
$passwordInput = new InputText();
$passwordInput->setType('password');
$passwordInput->setLabel('password');
$passwordInput->setRequired();

//the submit button
$submitInput = new InputText();
$submitInput->setType('submit');

//Set the form fields 
$fields = [
    'username' => $usernameInput,
    'password' => $passwordInput,
    'submit' => $submitInput,
];

$form = new Form($name, $id, $fields); // made via, $name, $id and the 3 objects passed into an array


echo '<h1>Hello. Please login</h1>';
echo $form->getStartTag().PHP_EOL;
foreach($form->getFields() as $field){
    if($field->label) echo $field->label. ": ";
    echo $field->getInput().'<br/>';
}
echo $form->getEndTag();

?>