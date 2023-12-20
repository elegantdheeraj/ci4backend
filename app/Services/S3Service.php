<?php
// App/Services/S3Service.php

namespace App\Services;

use Aws\S3\S3Client;

class S3Service
{
    protected $s3Client;
    protected $bucket;

    public function __construct()
    {
        // Set your AWS credentials and region
        $this->s3Client = new S3Client([
            'version'     => 'latest',
            'region'      => env('aws_region'),
            'credentials' => [
                'key'    => env('aws_access_key'),
                'secret' => env('aws_secret_key'),
            ],
        ]);
        $this->bucket = env('aws_bucket');
    }

    public function uploadFile(string $key, $file)
    {
        

        $result = $this->s3Client->putObject([
            'Bucket' => $this->bucket,
            'Key'    => $key,
            'Body'   => fopen($file->getTempName(), 'rb'),
            'StorageClass' => 'REDUCED_REDUNDANCY',
            'content_type' => $file->getClientMimeType(),
            'ACL'        => 'public-read'
        ]);
        if ($result) {
            // Get the URL of the uploaded file
            $url = $this->s3Client->getObjectUrl($this->bucket, $key);
            return $url;
        }
        return false;
    }

    // Add more methods for S3 operations as needed
}
