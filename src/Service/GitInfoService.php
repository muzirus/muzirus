<?php declare(strict_types=1);

namespace App\Service;

class GitInfoService
{
    /**
     * @var string
     */
    private $commitHash;

    /**
     * @var string
     */
    private $commitDate;

    //-------------------------------------------------------------------------

    public function getHash(): string
    {
        if ($this->isExecAvailable()) {
            if ($this->commitHash === null) {
                $this->commitHash = $this->getCommitHash();
            }

            return $this->commitHash;
        }

        return microtime();
    }

    public function getDate(): string
    {
        if ($this->isExecAvailable()) {
            if ($this->commitDate === null) {
                $this->commitDate = $this->getCommitDate();
            }

            return $this->commitDate;
        }

        return 'Unknown date';
    }

    //-------------------------------------------------------------------------

    private function getCommitHash(): string
    {
        return trim(exec('git log --pretty="%h" -n1 HEAD'));
    }

    private function getCommitDate(string $format = 'Y-m-d H:i'): string
    {
        $result = trim(exec('git log -1 --format=%ci --date=local'));

        if ($format === null) {
            return $result;
        }

        return (new \DateTime($result))->format($format);
    }

    private function isExecAvailable(): bool
    {
        if ($this->isSafeModeEnabled()) {
            return false;
        }

        if ($this->isExecDisabled()) {
            return false;
        }

        if ($this->execDoesNotExist()) {
            return false;
        }

        return true;
    }

    private function isSafeModeEnabled(): bool
    {
        return in_array(mb_strtolower(ini_get('safe_mode')), ['on', '1'], true);
    }

    private function isExecDisabled(): bool
    {
        return in_array('exec', explode(',', ini_get('disable_functions')), true);
    }

    private function execDoesNotExist(): bool
    {
        return !function_exists('exec');
    }
}
