# reactphp-parrot-ar-drone

> ### 🚁 Allows user to control a Parrot AR Drone over PHP

## Introduction

This library provide the same features that the node library (`node-ar-drone`), that's why this documentation is heavy based on the node-ar-drone one. *The low level UdpControl API is not implemented yet.*

This library is built on the awesome `reactphp` library which bring non blocking I/O system to PHP.

## Installation

Using Composer:

```bash
$ composer require mamoruheart/reactphp-parrot-ar-drone dev-main
```

## Usage

Some examples are located in the `examples/` directory. Feel free to test.

### Client API

```php
$client = new \Codeguru\ArDrone\Client();
// use API service (see below)
$client->start();
```

#### $client->takeoff($callback)

Sets the internal `fly` state to `true`, `$callback` is invoked after the drone
reports that it is hovering.

#### $client->land($callback)

Sets the internal `fly` state to `false`, `$callback` is invoked after the drone
reports it has landed.

#### $client->up($speed) / $client->down($speed)

Makes the drone gain or reduce altitude. `$speed` can be a value from `0` to `1`.

#### $client->clockwise($speed) / $client->counterClockwise($speed)

Causes the drone to spin. `$speed` can be a value from `0` to `1`.

#### $client->front($speed) / $client->back($speed)

Controls the pitch, which a horizontal movement using the camera
as a reference point.  `$speed` can be a value from `0` to `1`.

#### $client->left($speed) / $client->right($speed)

Controls the roll, which is a horizontal movement using the camera
as a reference point.  `$speed` can be a value from `0` to `1`.

#### $client->stop()

Sets all drone movement commands to `0`, making it effectively hover in place.

#### Events

A client will emit `landed`, `hovering`, `flying`, `landing`, `batteryChange`, and `altitudeChange` events as long as demo navdata is enabled. Here is a example for catching event: 

```php
$client->on('landed', function() {
    // do something
});
```

&copy; 2015 All Rights Reserved.
