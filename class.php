<?php
class Person{
    public $name = "Johnson";
    public $age = 25;

    function getPerson(){
        echo 'Welcome to person function';
    }
}

$p = new Person();
//$p->getPerson();
//echo $p->name;

class Student extends Person{
    public $department = 'Physics';

    function __construct(){
        echo "welcome to our school";
    }
}

$stud = new Student();