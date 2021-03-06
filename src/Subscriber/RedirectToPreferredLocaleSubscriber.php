<?php declare(strict_types=1);

namespace App\Subscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * When visiting the homepage, this listener redirects the user to the most
 * appropriate localized version according to the browser settings.
 *
 * See https://symfony.com/doc/current/components/http_kernel/introduction.html#the-kernel-request-event
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class RedirectToPreferredLocaleSubscriber implements EventSubscriberInterface
{
    private UrlGeneratorInterface $urlGenerator;

    /** @var string[] */
    private array $locales;

    private string $defaultLocale;

    public function __construct(UrlGeneratorInterface $urlGenerator, string $locales, string $defaultLocale = null)
    {
        $this->urlGenerator = $urlGenerator;

        $localesAsArray = explode('|', trim($locales));
        if ($localesAsArray === []) {
            throw new \UnexpectedValueException('The list of supported locales must not be empty.');
        }

        $this->locales = $localesAsArray;
        $this->defaultLocale = $defaultLocale ?? $this->locales[array_key_first($this->locales)];

        if (!in_array($this->defaultLocale, $this->locales, true)) {
            throw new \UnexpectedValueException(sprintf(
                'The default locale ("%s") must be one of "%s".',
                $this->defaultLocale,
                $locales
            ));
        }

        // Add the default locale at the first position of the array,
        // because Symfony\HttpFoundation\Request::getPreferredLanguage
        // returns the first element when no an appropriate language is found
        array_unshift($this->locales, $this->defaultLocale);
        $this->locales = array_unique($this->locales);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => 'onKernelRequest',
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        // Ignore sub-requests and all URLs but the homepage
        if (!$event->isMasterRequest() || $request->getPathInfo() !== '/') {
            return;
        }

        // Ignore requests from referrers with the same HTTP host in order to prevent
        // changing language for users who possibly already selected it for this application.

        /** @var string $referer */
        $referer = $request->headers->get('referer', '', true);

        if (mb_stripos($referer, $request->getSchemeAndHttpHost()) === 0) {
            return;
        }

        $preferredLanguage = $request->getPreferredLanguage($this->locales);

        if ($preferredLanguage !== $this->defaultLocale) {
            $response = new RedirectResponse(
                $this->urlGenerator->generate(
                    'app.index',
                    [
                        '_locale' => $preferredLanguage,
                    ]
                )
            );
            $event->setResponse($response);
        }
    }
}
