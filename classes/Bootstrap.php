<?php 
class Bootstrap{
    private $controller;
    private $action;
    private $request;

    public function __construct($request){
        $this->request = $request;
        if($this->request['controller'] == ""){
            $this->controller = 'home';
        }else{
            $this->controller = $this->request['controller'];
        }
        if($this->request['action'] == ""){
            $this->action = 'index';
        }else{
            $this->action = $this->request['action'];
        }
    }

    public function createController(){
        //Check for class
        if(class_exists($this->controller)){
            $parents = class_parents($this->controller);

            if(in_array("Controller", $parents)){
                if(methods_exists($this->controller, $this->action)){
                    return new $this->controller($this->action, $this->request);
                }else{
                    //Method not exist
                    echo '<h1>Method does not exist</h1>';
                    return;
                }
            }else{
                //Base controller not exist
                echo '<h1>Base Controller not found</h1>';
                return;
            }
        }else{
            //Controller class does not exist
            echo '<h1>Controller class does not exist</h1>';
        }
    }
}