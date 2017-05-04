<?php

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
  $routes->get('/login', function() {
    UserController::login();
  });
  
  $routes->post('/login', function() {
    UserController::handle_login();
  });
  
  $routes->post('/logout', function() {
    UserController::logout();
  });
  
  $routes->get('/', function(){
    AskareController::index(); 
  });
  
  $routes->post('/askare', function(){
    AskareController::store();
  });
  
  $routes->get('/askare/new', function(){
    AskareController::create();
  });

  $routes->get('/askare/:id', function($id){
    AskareController::show($id);
  });
  
  $routes->get('/askare/:id/edit', function($id) {
    AskareController::edit($id);
  });
  
  $routes->post('/askare/:id/edit', function($id) {
    AskareController::update($id);
  });
  
  $routes->post('/askare/:id/remove', function($id) {
    AskareController::remove($id);
  });
  
  $routes->get('/luokka', function(){
    LuokkaController::luokat(); 
  });
  $routes->post('/luokkastore', function(){
    LuokkaController::store(); 
  });
  
    $routes->get('/luokka/new', function(){
    LuokkaController::create();
  });

  $routes->get('/luokka/:id', function($id){
    LuokkaController::show($id);
  });
  
  $routes->get('/luokka/:id/edit', function($id) {
    LuokkaController::edit($id);
  });
  
  $routes->post('/luokka/:id/edit', function($id) {
    LuokkaController::update($id);
  });
  
  $routes->post('/luokka/:id/remove', function($id) {
    LuokkaController::remove($id);
  });
  
  $routes->get('/luokka/:id/show', function($id){
    LuokkaController::one($id);
  });