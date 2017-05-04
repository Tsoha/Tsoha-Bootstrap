<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/login.html', function() {
    HelloWorldController::login();
});
$routes->get('/memorylist.html', function() {
    HelloWorldController::memorylist();
});

$routes->get('/reg.html', function() {
    HelloWorldController::reg();
});

$routes->get('/edit_memory.html', function() {
    HelloWorldController::edit_memory();
});
$routes->get('/memo_page.html', function() {
    HelloWorldController::memo_page();
});
