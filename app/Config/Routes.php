<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('selection', 'Home::selectionMois');
$routes->get('note', 'Home::note');
$routes->post('note', 'Home::note');
$routes->get('nouveau', 'Home::nouveau');
$routes->post('nouveau', 'Home::nouveau');
$routes->get('edition', 'Home::edition');
$routes->get('validation', 'Home::validation');
$routes->post('validation', 'Home::validation');
$routes->get('deconnexion', 'Home::deconnexion');
$routes->post('login', 'Home::login');
$routes->get('forfait', 'Home::forfait');
$routes->get('horsforfait', 'Home::horsForfait');
$routes->post('nouvelleFicheForfait', 'Home::nouvelleFicheForfait');
$routes->post('nouvelleHorsForfait', 'Home::nouvelleHorsForfait');
// Redirige sur index car on est pas censé pouvoir y aller en GET
$routes->get('login', 'Home::index');


