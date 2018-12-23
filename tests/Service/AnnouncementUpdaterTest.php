<?php declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\Announcement;
use App\Form\Announcement\AnnouncementFormData;
use App\Service\AnnouncementUpdater;
use PHPUnit\Framework\TestCase;

class AnnouncementUpdaterTest extends TestCase
{
    /** @var AnnouncementUpdater */
    private $announcementUpdater;

    protected function setUp(): void
    {
        $this->announcementUpdater = new AnnouncementUpdater();
    }

    public function testUpdateFromFormData(): void
    {
        $title = 'title';
        $content = 'content';
        $formData = new AnnouncementFormData();
        $formData->setContent($content);
        $formData->setTitle($title);
        $abbreviation = new Announcement('bla', 'ble');

        $this->announcementUpdater->updateAnnouncement($abbreviation, $formData);

        $this->assertSame($title, $abbreviation->getTitle());
        $this->assertSame($content, $abbreviation->getContent());
    }
}
