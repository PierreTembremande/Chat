<?php

declare(strict_types=1);

namespace App\Cor;

use App\Security\Authorisation;
use App\Exceptions\AuthorisationException;
use App\Routing\Request;

class SecurityHandler extends SecurityTool
{
    private const ACCESS_CONTROL = ['/protected'];

    public function handle(Request $request): string
    {
        try {

            $authorisation = new Authorisation();
            $authorisation->authorize($request);
            
        } catch (AuthorisationException) {
            if (in_array($request->path, self::ACCESS_CONTROL)) {
                header('HTTP/1.1 401 Unauthorized');
                return '';
            }
        }

        return parent::handle($request);
    }
}
