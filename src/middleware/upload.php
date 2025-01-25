<?php
declare(strict_types=1);
namespace RestJS\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\UploadedFileInterface;

/** File Upload Middleware */
class Upload implements MiddlewareInterface {

    public function process(Request $req, RequestHandler $handler): ResponseInterface {

        /** User Upload File */
        $uploadedFile = $req->getUploadedFiles();

        foreach ($uploadedFile as $key => $value):

            /** Upload File Path */
            $file = self::moveUploadedFile('../content/', $key, $value);

            /** Added Upload File Value with User Form Data */
            $req = $req->withParsedBody([...$req->getParsedBody(), $key => $file]);
        endforeach;

        return $handler->handle($req);
    }

    /** File Upload to Server Function */
    private function moveUploadedFile(string $directory, string $type, UploadedFileInterface $uploadedFile) {

        /** File Extension */
        $ext = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);

        /** Upload File Name */
        $filename = strtoupper($type) . "_" . time() . ".{$ext}";

        // Check and Create Target Directory
        !is_dir($directory) && mkdir($directory);

        // File Upload to Server
        $uploadedFile->moveTo("{$directory}{$filename}");

        return "{$directory}{$filename}";
    }
}