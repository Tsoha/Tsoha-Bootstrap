<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });

  $routes->get('/kaupat', function() {
    KauppaController::index();
  });

  $routes->get('/tuotehaku', function() {
    TuoteController::tuotehaku();
  });

  $routes->get('/tuotteet', function() {
    TuoteController::index();
  });

  $routes->get('/kauppayhtymat', function() {
    KauppayhtymaController::index();
  });

  $routes->post('/kaupat', function() {
    KauppaController::store();
  });

  $routes->post('/tuotteet', function() {
    TuoteController::store();
  });

  $routes->post('/kauppayhtymat', function() {
    KauppayhtymaController::store();
  });

  $routes->get('/kaupat/uusi', function() {
    KauppaController::uusi_kauppa();
  });

  $routes->get('/kaupat/:id', function($id) {
    KauppaController::show($id);
  });

  $routes->get('/kauppayhtymat/:id', function($id) {
    KauppayhtymaController::show($id);
  });

  $routes->get('/kauppayhtymat/uusi', function($id) {
    KauppayhtymaController::show($id);
  });

  $routes->get('/tuotteet/:id', function($id) {
    TuoteController::show($id);
  });

  $routes->get('/tuotteet/uusi', function() {
    TuoteController::uusi_tuote();
  });

  $routes->get('/kauppayhtymat/uusi', function() {
    KauppayhtymaController::uusi_kauppayhtyma();
  });

  $routes->get('/uusi_ostotapahtuma', function() {
    OstotapahtumaController::uusi_ostotapahtuma();
  });

  $routes->post('/uusi_ostotapahtuma', function() {
    OstotapahtumaController::store();
  });
