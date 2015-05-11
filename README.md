# RpcPhp

#### Client
```php
$redisClient = new \Redis();
$rpc = new \RpcPhp\Client($redisClient);

$queue = 'Youtube';
$remoteFunction = 'fetchVideos';
$parameters = ['UCH8zwr3rJOcgCApR_5z31cw']
$message = new \Components\Rpc\Message($queue, $remoteFunction, $parameters);

// sync request
$response = $rpc->execute($message)

// or async request
$rpc->push($message);

// or pub/sub request
$rpc->publish($message)

```
