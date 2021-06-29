<?php
namespace Modules\MQTT\Properties\sensor;

use App\PropertyTypes\sensor\sensor;

/**
 * Class MQTT
 * @package App\PropertyTypes\sensor
 */
class MQTT extends sensor
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

    //API (GET): http://localhost/api/v2/device/(hostname)/state/(value)
    public function state($value){ 
        //This is where you control the light

        //This is how you notify Simple Home of the state change
        $this->setState('state', $value);
    }

}
