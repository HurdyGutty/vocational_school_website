<?php

namespace App\Lib\JWT;

use Firebase\JWT\Key;
use Firebase\JWT\JWT as BaseJWT;
use Exception;
use Psr\Container\ContainerInterface;

class JWT
{
    /**
     * @var ContainerInterface
     */
    protected ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    private function getPrivateKey(): string
    {
        return md5(env('SECRET_KEY'));
    }

    public function encode($data, $privateKey = null): string
    {
        if ($privateKey === null) {
            $privateKey = $this->getPrivateKey();
        }
        return BaseJWT::encode($data, $privateKey, 'HS256');
    }

    public function match($jwt, $privateKey = null): Exception|\stdClass
    {
        try {
            if ($privateKey === null) {
                $privateKey = $this->getPrivateKey();
            }
            return BaseJWT::decode($jwt, new Key($privateKey, 'HS256'));
        } catch (Exception $e) {
            return $e;
        }
    }
}
