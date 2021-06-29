<p align="center">
  <h1 align="center">Simple Home Module - MQTT</h3>
  <h3 align="center">A MQTT Module for Simple Home</h3>
  <p align="center">
    <a href="https://github.com/">Explore wikis</a>
    <sub><sup>•</sub></sup>
    <a href="https://github.com/">Report bugs</a>
  </p>
  <p align="center">
    <a href="https://github.com/Simple-Home/Simple-Home/search?l=php">
        <img src="https://img.shields.io/badge/PHP-brightgreen.svg"/>
    </a>
    <a href="https://laravel.com/">
        <img src="https://img.shields.io/badge/framework-Laravel-red.svg"/>
    </a>
    <a href="https://github.com/Simple-Home/Simple-Home/search?l=js">
        <img src="https://img.shields.io/badge/JS-red.svg"/>
    </a>
    <a href="https://github.com/Simple-Home/Simple-Home/search?l=html">
        <img src="https://img.shields.io/badge/HTML-blue.svg"/>
    </a>
    <a href="https://discord.gg/XJpT3UQ">
        <img src="https://img.shields.io/discord/604697675430101003.svg?color=Blue&label=Discord&logo=Discord"/>
    </a>
    <a href="./LICENSE">
        <img src="https://img.shields.io/badge/License-MIT-yellow.svg"/>
    </a>
  </p>
</p>

## Requirements
*  A MQTT Broker
*  Simple Home Server

## Installation
```composer require thebradleysanders/mqtt-module```

## Config Keys
#### Integration Settings
*  ```simplehome.integrations.MQTT.host```
*  ```simplehome.integrations.MQTT.port```
*  ```simplehome.integrations.MQTT.username```
*  ```simplehome.integrations.MQTT.password```
#### Device Type: light Settings
*  ```simplehome.device.(DeviceID).commandtopic```
*  ```simplehome.device.(DeviceID).brightnesstopic```
*  ```simplehome.device.(DeviceID).colortopic```
*  ```simplehome.device.(DeviceID).effecttopic```
*  ```simplehome.device.(DeviceID).colortemptopic```
#### Device Type: toggle Settings
*  ```simplehome.device.(DeviceID).commandtopic```

## License
Distributed under the MIT License. See `LICENSE` for more information.

## Contributors
<a href="https://github.com/Simple-Home/Simple-Home/graphs/contributors">
  <img src="https://contrib.rocks/image?repo=Simple-Home/Simple-Home" />
</a>

## Comunity
[![Join our Discord server!](https://invidget.switchblade.xyz/XJpT3UQ)](http://discord.gg/XJpT3UQ)
