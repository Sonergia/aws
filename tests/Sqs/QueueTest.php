<?php 

use PHPUnit\Framework\TestCase;
use Sonergia\Aws\Sqs\Queues;
use Sonergia\Aws\Sqs\Queue;
use Aws\Sqs\SqsClient;
use Aws\Credentials\Credentials;
use Sonergia\Aws\Sqs\Message;

class QueueTest extends TestCase
{
    /**
     *
     * @var Queues
     */
    private $queues;

    /**
     *
     * @var Queue
     */
    private $queue;

    private const QUEUE_NAME = "test-queue";

    public function setUp(): void
    {
        parent::setUp();

        $config = [
            'version' => $_ENV['version'],
            'region' => $_ENV['region'],
            'endpoint' => $_ENV['sqs_endpoint'],
            'credentials' => new Credentials($_ENV['credentials_key'], $_ENV['credentials_secret'])
        ];

        $sqsClient = new SqsClient($config);
        $this->queues = new Queues($sqsClient); 
        $this->queue = $this->queues->createQueue(self::QUEUE_NAME); 

    }

    public function tearDown(): void
    {
        parent::tearDown();
        $this->queues->deleteQueue($this->queue);
    }

    /**
     *
     * @test
     */
    public function message_sent_and_received_have_same_body(): void
    {
        $message = new Message('dummy');

        $this->queue->sendMessage($message);

        $messageFromQueue = $this->queue->receiveMessage();

        $this->queue->deleteMessage($messageFromQueue);
        $this->assertEquals((string) $message, (string) $messageFromQueue);
    }
}
