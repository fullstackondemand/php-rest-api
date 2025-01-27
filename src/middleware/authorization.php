<?php
declare(strict_types=1);
namespace RestJS\Middleware;

use RestJS\Api\User\Model as User;
use RestJS\Middleware\AbstractAuthMiddleware;

/** Authorization Middleware */
class Authorization extends AbstractAuthMiddleware {

    public function __construct(private User $user) { 
        parent::__construct($user);
    }
}