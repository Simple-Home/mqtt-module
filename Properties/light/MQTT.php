<?php
namespace Modules\MQTT\Properties\light;

use App\PropertyTypes\light\light;
use phpMQTT;

/**
 * Class MQTT
 * @package App\PropertyTypes\light
 */
class MQTT extends light
{
    public $supportedAttributes = ["connected"];

    public function __construct($meta){
        $this->meta = $meta;
        $this->features = $this->getFeatures($this);
        $this->settings = $meta['settings'];

        $this->mqttConnected = false;

        // Check if the needed config Keys are set
        if(!array_key_exists("host", $this->settings['integration'])
        || !array_key_exists("port", $this->settings['integration'])){
            exit("The MQTT Integration has not been setup"); //TODO: we need a log to report to
        }

        // MQTT Host Settings
        $host = $this->settings['integration']['host'];
        $port = $this->settings['integration']['port'];
        $username = $this->settings['integration']['username'];
        $password = $this->settings['integration']['password'];
        $will = "";
        $clientID = "SimpleHome".rand(1, 100);

        //Create MQTT Connection
        $this->MQTT = new \Modules\MQTT\phpMQTT($host, $port, $clientID);
        if($this->MQTT){
            if($this->MQTT->connect(true, $will, $username, $password)){
                $this->mqttConnected = true;
            }
        }
        $this->setAttributes('connected', (int)$this->mqttConnected);
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/state/(value)?color=red
    public function state($value, $args){ 
        if(!$this->mqttConnected) return;
        //This is where you control the light

        $this->MQTT->publish($this->settings['device']['commandtopic'], $value);
        $this->setState('state', $value);

        if(isset($args['brightness'])){
            $this->MQTT->publish($this->settings['device']['rightnesstopic'], $args['brightness']);
            $this->setState('brightness', $args['brightness']);
        }
        $this->MQTT->close();
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/brightness/(value)
    public function brightness($value){
        if(!$this->mqttConnected) return;
        //To just control the brightness use this

        //Brightness control code here
        $this->MQTT->publish($this->settings['device']['brightnesstopic'], $value);
        $this->setState('brightness', $value);
        $this->MQTT->close();
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/color/(value)
    public function color($value){
        if(!$this->mqttConnected) return;
        //To just control the color use this

        //Color control code here
        $this->MQTT->publish($this->settings['device']['colortopic'], $value);
        $this->setState('color', $value);
        $this->MQTT->close();
    }
    
    //API (GET): http://localhost/api/v2/device/(hostname)/effect/(value)
    public function effect($value){
        if(!$this->mqttConnected) return;
        //To just control the effect use this

        //Effect control code here
        $this->MQTT->publish($this->settings['device']['effecttopic'], $value);
        $this->setState('effect', $value);
        $this->MQTT->close();
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/colorTemp/(value)
    public function colorTemp($value){
        if(!$this->mqttConnected) return;
        //To just control the colorTemp use this

        //ColorTemp control code here
        $this->MQTT->publish($this->settings['device']['colortemptopic'], $value);
        $this->setState('colorTemp', $value);
        $this->MQTT->close();
    }
}