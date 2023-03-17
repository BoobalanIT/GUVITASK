<?php

//connect to the mongodb
$mongo_client = new MongoClient("mongodb://localhost:27017");

//select the database
$db = $mongo_client->mydatabase;

//select the collection
$collection = $db->users;

//connect to the redis
$redis_client = new Redis();
$redis_client->connect("127.0.0.1", 6379);

//retrieve the user from redis
$user_id = $redis_client->get("user_id");

//find the user in the mongodb
$user = $collection->findOne(array("_id" => $user_id));

//display the user profile
echo "Name: " . $user['name'] . "<br>";
echo "DOB " . $user['DOB'] . "<br>";
echo "gender: " . $user['gender'] . "<br>";
echo "location: " . $user['location'] . "<br>";

?>