<?php
require_once 'vendor/autoload.php';
require_once 'class/calculator.php';
Twig_Autoloader::register();



class App{
    private $loader;
    private $twig;
    private $app;
    public function __construct(){
        $this->app = new \Slim\Slim();

        $this->loader = new Twig_Loader_Filesystem('templates');
        $this->twig = new Twig_Environment($this->loader);

        self::routes();

        $this->app->run();
    }

    private function routes(){
        $this->app->get('/', function () {
            $template = $this->twig->loadTemplate('index.html');
            echo $template->render(array());
        });
        
        $this->app->get('/calculate/:number', function ($number) {
            $validation = true;

            $json = [];

            $number = (int)$number;
            if(!$number){
                $validation = false;
                $json['error'] = 'You need to enter number';
            }

            if($number <= 0 || $number > 1000){
                $validation = false;
                $json['error'] = 'You need to enter number from 1 to 1000';
            }

            if(!$validation){
                $json['status'] = 'error';
                
                echo json_encode($json);
                return;
            }

            $calculator = new Calculator($number);
        
            $json['result'] = $calculator->calculate();
            $json['status'] = 'success';
            echo json_encode($json);            
        });
    }
}

new App();