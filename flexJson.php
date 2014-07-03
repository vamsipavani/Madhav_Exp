<?php

class Person
{
  public $first_name;
  public $last_name;
  public $email;
  public $address;
}

class Manager extends Person
{
  public $title;
  public $employees;
}

if(isset($_GET['getPerson']))
{
  $p = new Person();
  $p->first_name = 'Chuck';
  $p->last_name = 'Killer';
  $p->email = 'fake@email.com';
  $p->address = '5555 Some Street City, State 52423';
  echo json_encode($p);
}

if(isset($_GET['getManager']))
{
  $p1 = new Person();
  $p1->first_name = 'Joe';
  $p1->last_name = 'Schmoe';
  $p1->email = 'joe.schmoe@email.com';
  $p1->address = '5424 Some Street City, State 12314';
  $p2 = new Person();
  $p2->first_name = 'Bob';
  $p2->last_name = 'Hacker';
  $p2->email = 'bob.hacker@email.com';
  $p2->address = '1414 Some Street City, State 12412';
  $p3 = new Person();
  $p3->first_name = 'Kevin';
  $p3->last_name = 'Putvin';
  $p3->email = 'kevin.putvin@email.com';
  $p3->address = '6123 Some Street City, State 41241';  
  $m = new Manager();
  $m->first_name = 'Manager';
  $m->last_name = 'Dude';
  $m->email = 'manager.dude@email.com';
  $m->address = '5534 Some Other Street City, State 91230';
  $m->title = 'Office Manager';
  $m->employees = array($p1, $p2, $p3);
  echo json_encode($m);  
}

?>