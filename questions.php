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
* a) saving changes because I might lose this.

/*
QUESTION 7
 * The following array contains a number of recipes and their corresponsing ingredients.
   Please rewrite the array so that each **ingredient** also contains:
 * a) a unit price
 * b) a quantity
*/

$recipes = [
    'Spindogs Magic Drink' => [
        'Sugar',
        'Chocolate',
        'Squash',
        'Coffee'
    ],
    'Spindogs Punch' => [
        'Rum',
        'Vodka',
        'Orange Juice',
        'Lime'
    ]
];

/*
QUESTION 8
 * Write some PHP code to loop through your array and show the following:
 * a) Display the name of each recipe and list the ingredients
 * b) Display the cost of each recipe
 * c) Display the total cost of **all recipes**
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
QUESTION 10
 * Write some PHP code to list the date of each day, starting with the current date
   and ending with the 10th day of the next month (in the format: Thursday 1st January 2015).
*/

/*
QUESTION 11
 * Describe in your own words the difference between a class and an object.
*/

/*
QUESTION 12
 * Write a single PHP class for a "Bear" (with approx. 50 lines of code). This is your opportunity
   to demonstrate your OOP understanding and coding style. You get to determine what properties and
   methods you use, but a "Bear" must be able to:
 * a) Eat honey every 2 hours and remember when they last had honey
 * b) Decide if they need to sleep
*/
