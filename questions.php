<?php
/*
# SPINDOGS TECHNICAL TASK

 * Please ensure that your coding style is consistent throughout
 * You will be scored on how elegant your solutions are for each question
 * The task should take around 60 mins in total, which leaves approx 5 mins per question
 * This task is designed to have a range of basic and complex questions - try to move
   through the more basic questions quickly in order to leave time for the more complex ones
 * If you get stuck on any question, please leave it and move on
 * Please type your answers below each question
*/

/*
 QUESTION 1
 * Write some PHP code to do the following:
 * a) Process the following form once it has been submitted
 * b) Check that the email is a valid address
 * c) Create a new record in a database table called Users - you can assume a
      database connection already exists - please ensure any SQL is secure

    <form method="post" action="yourscript.php">
        <input type="text" name="name">
        <input type="text" name="email">
        <input type="submit" name="submit" value="Submit">
    </form>
*/

/* 
 * ANSWER 1
 * a) This snippet would submit to 'yourscript.php', where we can check incoming $_POST requests, sanitised of course.
 * b) Use both regex in the html (now supported email types) as well as in the POST request script to check it's valid email e.g. '.' and '@' ... actually Laravel already has a validation feature to leverage this!
 * c) For security, SQL injections etc. don't do direct, prepared statements are key, so use leverage PDO's binding features, or MySQLi, or Eloquent ORM in Laravel.
 *    Once a) and b) are done, for c) It's basically something like:
 * $dbConn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbusername, $dbpassword);
 * $statement = $dbConn->prepare('INSERT INTO Users (name, email) VALUES (:name, :email');
 * $statement->execute(['name' => 'Jane Doe', 'email' => 'jdoe@example.com']);
 */

/*
QUESTION 2
 * Based on the data table below, please provide MySQL examples for the following requests:
 * a) Get all results
 * b) Edit an existing record
 * c) Delete an existing record

    +--------+-----------+--------+--------------+
    |                   Users                    |
    +--------+-----------+--------+--------------+
    | id     | name      | gender | is_logged_in |
    +--------+-----------+--------+--------------+
    | 1      | Elizabeth | Female | 1            |
    | 2      | Philip    | Male   | 0            |
    | 3      | Charles   | Male   | 0            |
    | 4      | William   | Male   | 0            |
    | 5      | Henry     | Male   | 0            |
    +--------+-----------+--------+--------------+
*/

/*
ANSWER 2
* a) 'SELECT * FROM Users;' // Or specifically type the id, name, gender, is_logged_in.  Number of reasons behind this actually...
* b) 'UPDATE Users SET name = 'John' WHERE id = 3;' // Or whatever record, but normally this would be dynamic in an app
* c) 'DELETE FROM Users WHERE id = 3;' // Again, could be any you want, but IRL we'd archive/soft delete not actually delete a record.
*/

/*
QUESTION 3
 * Looking at the above data table, suggest some appropriate data types and indexes for the columns.
*/

/*
ANSWER 3
* You'd probably want to keep an eye on users logged in and action on that event so an index for that likely.  Since boolean could go for a TINYINT(1) or the new boolean type.  Depends on your app.
*/

/*
QUESTION 4
 * A new table (see below) links sports to a user. Write a MySQL query to return the
   name of the person and their favourite sport. If they do not have a favourite sport,
   their name should still appear in the list.

    +-------------+----------+--------------+
    |               UserSports              |
    +-------------+----------+--------------+
    | user_id     | sport    | is_favourite |
    +-------------+----------+--------------+
    | 1           | Tennis   | 1            |
    | 2           | Football | 0            |
    | 3           | Tennis   | 1            |
    | 4           | Cricket  | 1            |
    | 4           | Football | 0            |
    | 4           | Rugby    | 0            |
    | 5           | Rugby    | 1            |
    +-------------+----------+--------------+
*/

/*
ANSWER 4
* 'SELECT u.name, s.sport FROM Users u LEFT JOIN UserSports on u.id = s.id;'
*/

/*
QUESTION 5
 * Describe in your own words what you would need to do if you wanted to list the name of
   each person alongside all the sports that they play separated by a comma (,)?
*/

/*
ANSWER 5
* There's several ways i.e. a MySQL query using the the joins and concat with comma to get a list.  Or if in a web app, then implode() on the array with a comma separated list as a string.  There's more but these are the 2 common ones and can even be used together.
*/

/*
QUESTION 6
 * Another table (see below) stores orders for an online shop, please provide MySQL examples
   for the following requests:
 * a) Write a single query to return each user's name alongside their total_spend
 * b) Write a single query to return each user's name alongside their latest_order_total
 * c) Write a single query to return the name of each month alongside the total_monthly_income

    +------------+---------+---------------------+-------+
    |                       Orders                       |
    +------------+---------+---------------------+-------+
    | id         | user_id | date_ordered        | cost  |
    +------------+---------+---------------------+-------+
    | 1          | 1       | 2015-01-01 00:00:00 | 90.00 |
    | 2          | 1       | 2015-02-30 00:00:00 | 7.00  |
    | 3          | 2       | 2015-05-05 00:00:00 | 12.00 |
    | 4          | 3       | 2015-05-20 00:00:00 | 50.00 |
    +------------+---------+---------------------+-------+
*/

/*
ANSWER 6
* a) Wait hang on, why is February on a 30th?! Arrgghh you sneaky... anyway:
      'SELECT u.name, SUM(o.cost) AS total_spend FROM Users u INNER JOIN Orders o ON u.id = o.user_id GROUP BY u.name;'
* b) Unless I'm interpreting wrong, isn't this just the same except an ORDER DESC? i.e. 'SELECT u.name SUM(o.cost) AS latest_order_total FROM Users u INNER JOIN Order o ON u.id = o.user_id GROUP BY u.name ORDER BY o.date_ordered DESC;'
* c) select the month from the datetime, alongside the grouping for sum of cost for that month (jan, feb, may - and relevant total cost)
/*
QUESTION 7
 * The following array contains a number of recipes and their corresponsing ingredients.
   Please rewrite the array so that each **ingredient** also contains:
 * a) a unit price
 * b) a quantity
*/

/* ANSWER 7

$recipes = [
    'Spindogs Magic Drink' => [
        'Sugar' => ['unit_price' => 2.00, 'qty' => 2],
        'Chocolate' => ['unit_price' => 2.50, 'qty' => 2],
        'Squash' => ['unit_price' => 4.00, 'qty' => 1],
        'Coffee' => ['unit_price' => 5.00, 'qty' => 1],
    ],
    'Spindogs Punch' => [
        'Rum' => ['unit_price' => 3.00, 'qty' => 1],
        'Vodka' => ['unit_price' => 2.00, 'qty' => 2],
        'Orange Juice' => ['unit_price' => 3.50, 'qty' => 3],
        'Lime' => ['unit_price' => 4.00, 'qty' => 1],
    ],
];
*/

/*
QUESTION 8
 * Write some PHP code to loop through your array and show the following:
 * a) Display the name of each recipe and list the ingredients
 * b) Display the cost of each recipe
 * c) Display the total cost of **all recipes**
*/

/*
ANSWER 8
* a) foreach ($recipes as $rec => $ings) {
       echo "$rec\n";
    
       foreach ($ings as $ing => $sums) {
         echo "- $ing\n";
       }
     }
     
     /* Output:
     Spindogs Magic Drink
      - Sugar
      - Chocolate
      - Squash
      - Coffee
      Spindogs Punch
      - Rum
      - Vodka
      - Orange Juice
      - Lime */
/*
      
* b) foreach ($recipes as $rec => $ings) {
       foreach ($ings as $ing => $sums) {
         echo "$ing Cost: " . $sums['unit_price'] * $sums['qty'] . "\n";
       }
     }
     
    /* Output:
      Sugar Cost: 4
      Chocolate Cost: 5
      Squash Cost: 4
      Coffee Cost: 5
      Rum Cost: 3
      Vodka Cost: 4
      Orange Juice Cost: 10.5
      Lime Cost: 4 */
/*      
* c) $sumAllRecipes = [];
      foreach ($recipes as $rec => $ings) {
          foreach ($ings as $ing => $sums) {
              $sumAllRecipes[] = $sums['unit_price'] * $sums['qty'];
          }
      }
      
      echo "Total cost of ALL recipes: " . array_sum($sumAllRecipes);
      
      // Output:
      // Total cost of ALL recipes: 39.5
*/

/*
QUESTION 9
 * Take a look at the example below. Please describe any security issues that you identify
   and make a suggestion how the issue could be resolved.

    <h1>Products page</h1>

    <p>Hello <?= $_GET['name']; ?>, how are you today?</p>

    <?php if (is_logged_in()) { ?>

        <table>
            <tr>
                <td>Example product 1</td>
                <td><a href="delete.php?id=1">Delete</a></td>
            </tr>
            <tr>
                <td>Example product 2</td>
                <td><a href="delete.php?id=2">Delete</a></td>
            </tr>
        </table>

    <?php } ?>
*/

/*
ANSWER 9
* Ideally, we shouldn't be mixing PHP server-side and front-end code together like this.
* The global request variables shouldn't be used, but if so, should be sanitised.  It's being echoed straight away without even checking that there's a request incoming in the first place.
* Where is the 'is_logged_in()' coming from? Why are there no other permission masks, roles, identities etc.?
* Literally anyone logged in could just go ahead and DELETE a product!
* The product IDs should be dynamic and not hard-coded.
* Consider a PHP compatible templating such as Twig or Blade.  This is really really messy.
*/

/*
QUESTION 10
 * Write some PHP code to list the date of each day, starting with the current date
   and ending with the 10th day of the next month (in the format: Thursday 1st January 2015).
*/
/*
ANSWER 10

<?php
// You can use date() or the DateTime for this, either or combo should work.
   // Current day in the format specified
   echo date('l dS F Y');
   
   // Output:
   // Thursday 22nd August 2019
   
   // If you want every day of the month from current then:
   $start    = new DateTime('today');
   $end      = new DateTime('last day of this month');
   $interval = new DateInterval('P1D');
   $period   = new DatePeriod($start, $interval, $end);
   foreach ($period as $dt) {
       echo $dt->format('l dS F Y') . "\n";
   }

   // 10th day of next month
   echo date('l dS F Y', strtotime('+9 days', strtotime('first day of ' . ((int)date('j') < 10 ? 'this' : 'next' ) . ' month')));
*/

/*
QUESTION 11
 * Describe in your own words the difference between a class and an object.
*/
/*
ANSWER 11

You'd create a class, which is kind of like the blueprint.  You instantiate it then as an object with whatever properties.  E.g. a car, or animal or whatever.  Want me to quote StackOverflow? There's so many different types of classes and extentions and interfaces and templates etc.

*/

/*
QUESTION 12
 * Write a single PHP class for a "Bear" (with approx. 50 lines of code). This is your opportunity
   to demonstrate your OOP understanding and coding style. You get to determine what properties and
   methods you use, but a "Bear" must be able to:
 * a) Eat honey every 2 hours and remember when they last had honey
 * b) Decide if they need to sleep
*/

/*
ANSWER 12

<?php

namespace App;

class Bear
{

   public $lastEatenHoney;
   public $isAsleep;

   public function __construct(\DateTime $lastEatenHoney) {
      $this->lastEatenHoney = $lastEatenHoney;
      $this->isAsleep = false;
   }
   
   public function getLastEatenHoney() {
      return $this->lastEatenHoney;
   }
   
   public function setLastEatenHoney(\DateTime $lastEatenHoney) {
      return $this->lastEatenHoney = $lastEatenHoney;
   }
   
   public function canEatHoney() {
      $now = new \DateTime();
      return $now->diff($this->getLastEatenHoney())->format('%h') >= 2;
   }
   
   public function eatHoney() {
      $this->setLastEatenHoney(new \DateTime());
   }
   
   public function sleep() {
      $this->isAsleep = true;
   }
   
   public function awake() {
      $this->isAsleep = false;
   }
}
*/

// Note: not the way you'd normally do it, since PHP 7+ and MVC frameworks, using interface classes and implenting this Bear as an Animal or whatever, checking the lifecycle/energy of the bear and so on, so that more control over dynamic sleeping and eating and waking and shitting...
