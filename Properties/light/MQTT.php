<?php
namespace Modules\MQTT\Properties\light;

use App\PropertyTypes\light\light;

/**
 * Class Example
 * @package App\PropertyTypes\light
 */
class MQTT extends light
{
    public $supportedAttributes = ["wifi","battery","uptime", "s/n", "model"];

    public function __construct($meta){
        $this->meta = $meta;
        $this->features = $this->getFeatures($this);
        $this->settings = $meta['property']->settings;

        //Set property properties, these can be anything!
        //$this->setAttributes('s/n', "DMRM36078");
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/state/(value)?color=red
    public function state($value, $args){ 
        //This is where you control the light

        //This is how you notify Simple Home of the state change
        $this->setState('state', $this->propertySettings);
        $this->setState('brightness', $args['brightness']);
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/brightness/(value)
    public function brightness($value){  
        //To just control the brightness use this

        //Brightness control code here
        $this->setState('brightness', $value);
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/color/(value)
    public function color($value){
        //To just control the color use this

        //Color control code here
        $this->setState('color', $value);
    }
    
    //API (GET): http://localhost/api/v2/device/(hostname)/effect/(value)
    public function effect($value){
        //To just control the effect use this

        //Effect control code here
        $this->setState('effect', $value);
    }

    //API (GET): http://localhost/api/v2/device/(hostname)/colorTemp/(value)
    public function colorTemp($value){
        //To just control the colorTemp use this

        //ColorTemp control code here
        $this->setState('colorTemp', $value);
    }
}
