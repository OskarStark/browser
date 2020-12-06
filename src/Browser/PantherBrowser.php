<?php

namespace Zenstruck\Browser;

use Symfony\Component\Panther\Client;
use Zenstruck\Browser;

/**
 * @author Kevin Bond <kevinbond@gmail.com>
 *
 * @method Client inner()
 */
class PantherBrowser extends Browser
{
    final public function __construct(Client $inner)
    {
        parent::__construct($inner);
    }

    final public function inspect(): self
    {
        if (!($_SERVER['PANTHER_NO_HEADLESS'] ?? false)) {
            throw new \RuntimeException('The "PANTHER_NO_HEADLESS" env variable must be set to inspect.');
        }

        \fwrite(STDIN, "\n\nInspecting the browser.\n\nPress enter to continue...");
        \fgets(STDIN);

        return $this;
    }
}
