<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('suunnitelmat/login', function() {
  HelloWorldController::login();
});
$routes->get('suunnitelmat/memorylist', function() {
  HelloWorldController::memorylist();
});

$routes->get('suunnitelmat/reg', function() {
  HelloWorldController::reg();
});

$routes->get('suunnitelmat/edit_memory', function() {
  HelloWorldController::edit_memory();
});
$routes->get('suunnitelmat/memo_page', function() {
  HelloWorldController::memo_page();
});
