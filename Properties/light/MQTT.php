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

        // MQTT Host Settings
        $host = $this->settings['integration']['simplehome.integrations.MQTT.host'];
        $port = 1883;
        $username = $this->settings['integration']['simplehome.integrations.MQTT.username'];
        $password = $this->settings['integration']['simplehome.integrations.MQTT.password'];
        $will = "";
        $clientID = "SimpleHome".rand(1,100);

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
            $this->MQTT->publish($this->settings['device']['commandtopic'], $args['brightness']);
            $this->setState('brightness', $args['brightness']);
        }
        $this->MQTT->close();
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/brightness/(value)
    public function brightness($value){
        if(!$this->mqttConnected) return;
        //To just control the brightness use this

        //Brightness control code here
        $this->MQTT->publish($this->settings['device']['commandtopic'], $value);
        $this->setState('brightness', $value);
        $this->MQTT->close();
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/color/(value)
    public function color($value){
        if(!$this->mqttConnected) return;
        //To just control the color use this

        //Color control code here
        $this->MQTT->publish($this->settings['device']['commandtopic'], $value);
        $this->setState('color', $value);
        $this->MQTT->close();
    }
    
    //API (GET): http://localhost/api/v2/device/(hostname)/effect/(value)
    public function effect($value){
        if(!$this->mqttConnected) return;
        //To just control the effect use this

        //Effect control code here
        $this->MQTT->publish($this->settings['device']['commandtopic'], $value);
        $this->setState('effect', $value);
        $this->MQTT->close();
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/colorTemp/(value)
    public function colorTemp($value){
        if(!$this->mqttConnected) return;
        //To just control the colorTemp use this

        //ColorTemp control code here
        $this->MQTT->publish($this->settings['device']['commandtopic'], $value);
        $this->setState('colorTemp', $value);
        $this->MQTT->close();
    }
}