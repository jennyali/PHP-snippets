<?php
/*  PHP code to practice a class to make a html form */


    class Form{
        const NAME = 'StdForm'; 
        /* This is a constant, 'const' is its syntax and the word 
        you write is all CAPS 
        - they are global and can be used through out script
        - the value cannot be changed.
        */

        protected $elements =[];
        protected $name = 'Login';
        public $valid = false; 
        // protected & public are visibility settings
        // $variables in a class are know as 'properties'

        public function __construct($name, $id, array $fields = null){
        /* this is a magic method, it gets called when the user types 'new' followed by this classes name.
        */
            $this->name = $name;
            $this->id = $id;
            if($fields) {
                foreach($fields as $field){
                    $this->fields[] = $field;
                }
            }
        }

        public function getStartTag($attributes = null) {
        /* this is a method, aka a function
           it can have perameters passed in just like functions
           it also, like class properties starts with a visiblity; public, protected, private  */    
            
            if (!attributes) return '<form>';
            $tag = '<form';
            foreach ($attributes as $key => $value) {
                $tag .= " $key=\"$value\"";
            }
            $tag.= '>';
            return $tag;
        }

        public function getEndTag(){
        // ^ also a METHOD 
            return '</form';
        }

        public function setName($name = null) {
        /* method that sets the name property, if name has no value then the code goes to
           the else part and sets it using the const NAME value. */
            if($name){
                $this->name = $name;
            } else {
                $this->name = self::NAME; // $this and self keywords relate to props/values from THIS class
            }
        }

        public function set($property, $value = null) {
        /* a generic SET function that creates a new object property based  
        on whats passed in to $property with its value set to passed in $value.
        UPDATE: $value = null, means if no value is sent in via 2nd parameter then it will equal null.
        */    
            $this->$property = $value;
        }

        public function getName(){
        /* this is a 'getter method' used to return a value,
        in this case the function returns the name value when called.
        */
            return $this->name;
        }

        public function setFormAttribs($attribs){
        /* this method will take in an array with pairs of 'keys' => 'values',
        it will take each string name and make it a new property of this object with its value set to the
        value passed in the array, e.g.  'nameAttribute' => 'Registration', 
        */
            foreach($attribs as $key => $value){
                $this->$key = $value;
            }
        }

        public function setId($id){
            $this->id = $id;
            return $this; // best practice for SETTER methods to return a $this. meaning $this object.
        }

    } 

    class Field {
        public $type;
        public $name;

        public function __construct($type, $name){
            $this->type = $type;
            $this->name = $name;
        }

        public function getName(){
            return $this-name;
        }

        public function getTag(){
            $html = "<input";
            $html .= " type=\"$this->type\"";
            $html .= " name=\"$this->name\"";
            $html .= ">";
            return $html;
        }
    }

    class Utility // Example of a class with STATIC property and method
    {
        public static $symbol = '$';
        public static function formatCurrency($value){
            return self::$symbol.$value;
        }
    }

?>