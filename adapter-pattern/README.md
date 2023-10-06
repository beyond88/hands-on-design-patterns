# Adapter Pattern
Adapter pattern works as a bridge between two incompatible interfaces. This pattern involves a single class which is responsible to join functionalities of independent or incompatible interfaces.

## Example
```php
<?php 
namespace DesignPattern\Adapter\Example;

interface Notification
{
    /**
     * 
     * Send message method definiation
     * 
     * @param string $title 
     * @param string $message
     */
    public function send(string $title, string $message);
}

/**
 * Send message throw email implementation
 * 
 * @package     DesignPattern
 * @subpackage  Adapter
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class EmailNotification implements Notification
{
    /**
     * 
     * @var $adminEmail
     */
    private $adminEmail; 

    /**
     * Assign admin email
     * 
     * @param string $adminEmail
     * @return void
     */
    public function __construct(string $adminEmail)
    {
        $this->adminEmail = $adminEmail;
    }

    /**
     * Send message
     * 
     * @param string $adminEmail
     * @return void
     */
    public function send(string $title, string $message): void
    {
        mail($this->adminEmail, $title, $message);
        echo "Sent email with title '$title' to '{$this->adminEmail}' that says '$message'.";
    }
}

/**
 * Send message throw Slack api
 * 
 * @package     DesignPattern
 * @subpackage  Adapter
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class SlackApi
{
    /**
     * 
     * @var $login
     */
    private $login;

    /**
     * 
     * @var $apiKey
     */
    private $apiKey;

    /**
     * Assign slack credential
     * 
     * @param string $login
     * @param string $apiKey
     * @return void
     */
    public function __construct(string $login, string $apiKey)
    {
        $this->login = $login;
        $this->apiKey = $apiKey;
    }

    /**
     * Print message when login into Slack
     * 
     * @return void
     */
    public function logIn(): void
    {
        echo "Logged in to a slack account '{$this->login}'.\n";
    }

    /**
     * Send message post request 
     * to Slack web service.
     * 
     * @param string $chatId
     * @param string $message
     * @return void
     */
    public function sendMessage(string $chatId, string $message): void
    {
        echo "Posted following message into the '$chatId' chat: '$message'.\n";
    }

}

/**
 * Send message throw Slack api
 * 
 * @package     DesignPattern
 * @subpackage  Adapter
 * @author      Mohiuddin Abdul Kader <muhin.cse.diu@gmail.com>
 */
class SlackNotification implements Notification
{
    /**
     * 
     * @var $slack
     */
    private $slack;

    /**
     * 
     * @var $chatId
     */
    private $chatId;

    /**
     * Assign SlackApi object and chat id
     * 
     * @param string $slack
     * @param string $chatId
     * @return void
     */
    public function __construct(SlackApi $slack, string $chatId)
    {
        $this->slack = $slack;
        $this->chatId = $chatId;
    }

    /**
     * Send message throw Slack
     * 
     * @param string $title
     * @param string $message
     * @return void
     */
    public function send(string $title, string $message): void
    {
        $slackMessage = "#" . $title . "# " . strip_tags($message);
        $this->slack->logIn();
        $this->slack->sendMessage($this->chatId, $slackMessage);
    }

}

function clientOperation(Notification $notification)
{
    // ...

    echo $notification->send("Website is down!",
    "<strong style='color:red;font-size: 50px;'>Alert!</strong> " .
    "Our website is not responding. Call admins and bring it up!");

    // ...
}

echo "Client code is designed correctly and works with email notifications:\n";
$notification = new EmailNotification("developers@example.com");
clientOperation($notification);
echo "\n\n";


echo "The same client code can work with other classes via adapter:\n";
$slackApi = new SlackApi("example.com", "XXXXXXXX");
$notification = new SlackNotification($slackApi, "Example.com Developers");
clientOperation($notification);
```
