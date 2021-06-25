<?php

namespace Sonergia\Aws\Sqs;

use Aws\Sqs\SqsClient;
use Aws\Exception\AwsException;
use Aws\Result;

class Queue
{

    private $client;
    private $url;

    public function __construct(SqsClient $client, string $url)
    {
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * Queue Url
     *
     * @return string
     */
    public function url(): string
    {
        return $this->url;
    }

    /**
     * Send message
     *
     * @param Message $message
     * @return Result
     */
    public function sendMessage(Message $message): Result
    {
        try {
            $params = [
                Params::DELAY_SECONDS => 0,
                Params::MESSAGE_ATTRIBUTES => $message->attributes(),
                Params::MESSAGE_BODY => (string) $message,
                Params::QUEUE_URL => $this->url
            ];
            return $this->client->sendMessage($params);
        } catch (AwsException $e) {
            throw new AwsSqsException("Send SQS Message failed", 0, $e);
        }
    }

    /**
     * receive message
     *
     * @return Message|null
     */
    public function receiveMessage(): ?Message
    {
        try {
            $result = $this->client->receiveMessage(array(
                Params::ATTRIBUTE_NAMES => [Params::SENT_TIMESTAMP],
                Params::MAX_NUMBER_OF_MESSAGES => 1,
                Params::MESSAGE_ATTRIBUTE_NAMES => [Params::ALL],
                Params::QUEUE_URL => $this->url, // REQUIRED
                Params::WAIT_TIME_SECONDS => 0,
            ));
            
            if (!empty($result->get(Params::MESSAGES))) {
                $data = $result->get(Params::MESSAGES)[0];
                return new Message(
                    $data[Params::BODY],
                    $data[Params::ATTRIBUTES],
                    $data[Params::MESSAGE_ID],
                    $data[Params::RECEIPT_HANDLE]
                );
            }
            return null;
        } catch (AwsException $e) {
            throw new AwsSqsException("Receive SQS Message failed", 0, $e);
        }
    }

    /**
     * Delete message
     *
     * @param Message $message
     * @return void
     */
    public function deleteMessage(Message $message)
    {
        try {
            $this->client->deleteMessage([
                Params::QUEUE_URL => $this->url, // REQUIRED
                Params::RECEIPT_HANDLE => $message->handle() // REQUIRED
            ]);
        } catch (AwsException $e) {
            throw new AwsSqsException("Delete SQS Message failed", 0, $e);
        }
    }
}
