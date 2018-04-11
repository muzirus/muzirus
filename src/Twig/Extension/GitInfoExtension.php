<?php declare(strict_types=1);

namespace App\Twig\Extension;

use App\Service\GitInfoService;

class GitInfoExtension extends \Twig_Extension
{
    /**
     * @var GitInfoService
     */
    private $gitInfoService;

    public function __construct(GitInfoService $gitInfoService)
    {
        $this->gitInfoService = $gitInfoService;
    }

    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction('get_git_commit_date', function () {
                return $this->gitInfoService->getDate();
            }),
            new \Twig_SimpleFunction('get_git_commit_hash', function () {
                return $this->gitInfoService->getHash();
            }),
        ];
    }
}
