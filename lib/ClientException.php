<?php

/**
 * HTTP Client Exception Handler
 *
 * @author    Nurlan Mukhanov <nurike@gmail.com>
 * @copyright 2019 Nurlan Mukhanov
 * @license   https://opensource.org/licenses/MIT The MIT License
 * @link      http://packagist.org/packages/sendgrid/php-http-client
 */

namespace SendGrid;

use Exception;

class ClientException extends Exception
{
    /**
     * @var ClientError[] $errors
     */
    protected $errors;

    /**
     * @var int $httpStatus HTTP status code
     */
    protected $httpStatus;

    /**
     * @var array $fullTrace Full Exception trace
     */
    protected $fullTrace;

    /**
     * @var array $shortTrace Place where send method was called
     */
    protected $shortTrace;

    /**
     * ClientException constructor.
     *
     * @param string $message
     * @param int    $httpStatus
     * @param int    $code
     */
    public function __construct($message = "unhandled body response", $httpStatus = 0, $code = 0)
    {
        $this->httpStatus = $httpStatus;

        $errors = null;

        // If message is set
        if($message) {
            // Trying to get an array
            $messageArray = json_decode($message, true);

            // If successfully parsed
            if($messageArray and isset($messageArray["errors"])) {
                $errors = $messageArray["errors"];

                // Parsing all errors
                if($errors && is_array($errors) and count($errors)) {
                    $this->message .= "ERRORS: \n";
                    foreach($errors as $error) {
                        $this->errors[] = new ClientError($error);

                        foreach($error as $key => $value) {
                            $this->message .= sprintf("  %-8s: %s\n", $key, $value);
                        }

                        $this->message .= "\n";
                    }
                }
            } else {
                $this->message = $message;
            }
        }  else {
            $this->message = $message;
        }

        $backTrace = parent::getTrace();
        $this->fullTrace = $backTrace;

        foreach($backTrace as $trace) {
            if(isset($trace['file'])) {
                $pathInfo = pathinfo($trace['file']);
                if($pathInfo['dirname'] == __DIR__ || (isset($trace['class']) && $trace['class'] == Client::class)) {
                    array_shift($backTrace);
                    continue;
                } else {
                    break;
                }
            }
        }
        $this->file = $backTrace[0]['file'];
        $this->line = $backTrace[0]['line'];

        $this->shortTrace = $backTrace;

        parent::__construct($this->message, $code);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getHttpStatus()
    {
        return $this->httpStatus;
    }

    public function getShortTrace()
    {
        return $this->shortTrace;
    }

    public function getFullTrace()
    {
        return $this->fullTrace;
    }
}
