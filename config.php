// Include necessary files
require_once 'path/to/TransportFactory.php';
require_once 'path/to/Email.php';

// Set up Mailtrap configuration
use Some\Mail\TransportFactory;
TransportFactory::setConfig('mailtrap', [
    'host' => 'sandbox.smtp.mailtrap.io',
    'port' => 2525,
    'username' => '08c21e81db04da',
    'password' => '3101864569b7a4',
    'className' => 'Smtp'
]);
