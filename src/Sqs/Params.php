<?php 

namespace Sonergia\Aws\Sqs;

interface Params
{
    public const QUEUE_NAME = 'QueueName';
    public const QUEUE_URL = 'QueueUrl';
    public const MESSAGE_BODY = 'MessageBody';
    public const MESSAGE_ATTRIBUTES = 'MessageAttributes';
    public const MESSAGE_ID = 'MessageId';
    public const DELAY_SECONDS = 'DelaySeconds';
    public const ATTRIBUTE_NAMES = 'AttributeNames';
    public const MAX_NUMBER_OF_MESSAGES = 'MaxNumberOfMessages';
    public const MESSAGE_ATTRIBUTE_NAMES = 'MessageAttributeNames';
    public const WAIT_TIME_SECONDS = 'WaitTimeSeconds';
    public const RECEIPT_HANDLE = 'ReceiptHandle';
    public const ATTRIBUTES = 'Attributes';
    public const MESSAGES = 'Messages';
    public const BODY = 'Body';
    public const ALL = 'All';
    public const SENT_TIMESTAMP = 'SentTimestamp';
}