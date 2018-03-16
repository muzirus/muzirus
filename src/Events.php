<?php

namespace App;

final class Events
{
    /** @Event("App\Event\CategoryEvent") */
    public const CATEGORY_CREATED = 'category.created';

    /** @Event("App\Event\CategoryEvent") */
    public const CATEGORY_UPDATED = 'category.updated';

    /** @Event("App\Event\RussianWordEvent") */
    public const RUSSIAN_WORD_CREATED = 'russian_word.created';

    /** @Event("App\Event\RussianWordEvent") */
    public const RUSSIAN_WORD_UPDATED = 'russian_word.updated';

    /** @Event("App\Event\CzechWordEvent") */
    public const CZECH_WORD_CREATED = 'czech_word.created';

    /** @Event("App\Event\CzechWordEvent") */
    public const CZECH_WORD_UPDATED = 'czech_word.updated';

    /** @Event("App\Event\SourceEvent") */
    public const SOURCE_CREATED = 'source.created';

    /** @Event("App\Event\SourceEvent") */
    public const SOURCE_UPDATED = 'source.updated';

    /** @Event("App\Event\SourceTypeEvent") */
    public const SOURCE_TYPE_CREATED = 'source_type.created';

    /** @Event("App\Event\SourceTypeEvent") */
    public const SOURCE_TYPE_UPDATED = 'source_type.updated';

    /** @Event("App\Event\TranslationEvent") */
    public const TRANSLATION_CREATED = 'translation.created';

    /** @Event("App\Event\TranslationEvent") */
    public const TRANSLATION_UPDATED = 'translation.updated';

    /** @Event("App\Event\TranslationExampleEvent") */
    public const TRANSLATION_EXAMPLE_CREATED = 'translation_example.created';

    /** @Event("App\Event\TranslationExampleEvent") */
    public const TRANSLATION_EXAMPLE_UPDATED = 'translation_example.updated';

    private function __construct()
    {
    }
}
