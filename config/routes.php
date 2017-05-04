<?php

//navigaatio linkit

$routes->get('/', function() {
    SiteController::index();
});

$routes->get('/henkilokunta', function() {
    SiteController::employee();
});

$routes->get('/kirjaudu', function() {
    SiteController::login();
});

$routes->get('/rekisteroidy', function() {
    SiteController::register();
});

$routes->get('/varaa', function() {
    SiteController::reservation();
});

$routes->get('/palvelut', function() {
    ServiceController::index();
});


//service

$routes->post('/palvelut/store', function() {
    ServiceController::store();
});

$routes->get('/palvelut/new', function() {
    ServiceController::create();
});

$routes->get('/palvelut/:id', function($id) {
    ServiceController::show($id);
});















// VANHAT VERSIOT TÄSTÄ ALESPÄIN

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/etusivu', function() {
    HelloWorldController::etusivu();
});

$routes->get('/palvelu', function() {
    HelloWorldController::service_list();
});
$routes->get('/tyontekija/', function() {
    HelloWorldController::employee_list();
});
$routes->get('/tyontekija/1', function() {
    HelloWorldController::employee_show();
});
$routes->get('/tyontekija/1/edit', function() {
    HelloWorldController::employee_edit();
});


