# Sonergia-aws

##  Aws PHP SDK wrapper library

Library for making work with AWS PHP SDK easier

### Installation

```
composer require sonergia/aws
```

### Modules:

#### SQS

Intended to be used with [Amazon Simple Queue Service](https://aws.amazon.com/fr/sqs/)  

##### Basic Usage

```
use Sonergia\Aws\Queue;
use Sonergia\Aws\Message;
use Aws\Sqs\SqsClient;
use Aws\Credentials\Credentials;

$client = new SqsClient([
    'version' => 'latest',
    'region' => 'eu-west-3',
    'credentials' => new Credentials($key, $secret)
]);

$queue = new Queue($client, $yourQueueUrl);
$queue->sendMessage(new Message('Hello'));

```

### Testing

-  Make your phpunit.xml (ex. phpunit.xml.dist)

```
cd aws
docker-compose up --build
docker exec -it  sonergia-aws-php vendor/bin/phpunit  --testdox
```


## Credits

Sqs Dockerfile : https://github.com/vsouza/docker-SQS-local 

## License
The MIT License (MIT)

Copyright (c) 2021 Sonergia

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
