<?php

class ServiceController extends BaseController {

    public static function index() {
        $services = Service::all();

        View::make('service/index.html', array('services' => $services));
    }

    public static function show($id) {
        $service = Service::find($id);

        View::make('service/show.html', array('service' => $service));
    }

    public static function create() {
        View::make('service/new.html');
    }

    public static function store() {

        $params = $_POST;

        $service = new Service(array(
            'name' => $params['name'],
            'price' => $params['price'],
            'description' => $params['description']
        ));
        
        $service->save();
        
        Redirect::to('/palvelut/' . $service->id, array('message' => 'Uusi palvelu luotu!'));
    }

}
