<?php
// src/EventSubscriber/BookMailSubscriber.php
 
namespace App\EventSubscriber;
 
use ApiPlatform\Symfony\EventListener\EventPriorities;
use App\Entity\Livre;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;
 
class BookMailSubscriber implements EventSubscriberInterface
{
    private $mailer;
 
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
 
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['sendMailOnBookAddition', EventPriorities::POST_WRITE],
        ];
    }
 
    public function sendMailOnBookAddition(ViewEvent $event): void
    {
        $book = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();
 
        if (!$book instanceof Livre || Request::METHOD_POST !== $method) {
           return;
        }
 
        $this->sendBookAddedEmail($book);
    }
 
    private function sendBookAddedEmail(Livre $book): void
    {
        $message = (new Email())
            ->from('system@example.com')
            ->to('noemiektourza@gmail.com')
            ->subject('A new book has been added')
            ->text(sprintf('The book #%d has been added.', $book->getId()));
 
        $this->mailer->send($message);
    }
}
 