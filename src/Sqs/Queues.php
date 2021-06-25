<?php

namespace Sonergia\Aws\Sqs;

use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;

class Queues
{

    private $client;

    public function __construct(SqsClient $client)
    {
        $this->client = $client;
    }

    /**
     * create new queue
     *
     * @param string $name
     * @return Queue
     */
    public function createQueue(string $name): Queue
    {
        try {
            $result = $this->client->createQueue(array(
                Params::QUEUE_NAME => $name,
                Params::ATTRIBUTES => []
            ));

            return new Queue($this->client, $result->get(Params::QUEUE_URL));
        } catch (AwsException $e) {
            throw new AwsSqsException("Create SQS Queue failed", 0, $e);
        }
    }

    /**
     * get queue
     *
     * @param string $name
     * @return Queue
     */
    public function getQueue(string $name): Queue
    {
        try {
            $result = $this->client->getQueueUrl([
                Params::QUEUE_NAME => $name // REQUIRED
            ]);

            return new Queue($this->client, $result->get(Params::QUEUE_URL));
        } catch (AwsException $e) {
            throw new AwsSqsException("Get SQS Queue failed", 0, $e);
        }
    }

    /**
     * delete queue
     *
     * @param Queue $queue
     * @return void
     */
    public function deleteQueue(Queue $queue)
    {
        try {
            $result = $this->client->deleteQueue([
                Params::QUEUE_URL => $queue->url() // REQUIRED
            ]);
        } catch (AwsException $e) {
            throw new AwsSqsException("Delete SQS Queue failed", 0, $e);
        }
    }
}
