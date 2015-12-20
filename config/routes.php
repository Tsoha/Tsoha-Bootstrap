<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function() {
  HelloWorldController::login();
});
$routes->get('/memorylist', function() {
  HelloWorldController::memorylist();
});

$routes->get('/reg', function() {
  HelloWorldController::reg();
});

$routes->get('/edit_memory', function() {
  HelloWorldController::edit_memory();
});
$routes->get('/memo_page', function() {
  HelloWorldController::memo_page();
});
