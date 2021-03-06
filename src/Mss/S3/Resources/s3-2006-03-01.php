<?php
/**
 * Copyright 2010-2013 Amazon.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://aws.amazon.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

return array (
    'apiVersion' => '2006-03-01',
    'endpointPrefix' => 's3',
    'serviceFullName' => 'Amazon Simple Storage Service',
    'serviceAbbreviation' => 'Amazon S3',
    'serviceType' => 'rest-xml',
    'timestampFormat' => 'rfc822',
    'globalEndpoint' => 's3.amazonaws.com',
    'signatureVersion' => 's3',
    'namespace' => 'S3',
    'regions' => array(
        'beijing' => array(
            'http' => true,
            'https' => true,
            'hostname' => 'mtmss.com',
        ),
    ),
    'operations' => array(
        'AbortMultipartUpload' => array(
            'httpMethod' => 'DELETE',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'AbortMultipartUploadOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/mpUploadAbort.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'UploadId' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'uploadId',
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The specified multipart upload does not exist.',
                    'class' => 'NoSuchUploadException',
                ),
            ),
        ),
        'CompleteMultipartUpload' => array(
            'httpMethod' => 'POST',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'CompleteMultipartUploadOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/mpUploadComplete.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'CompleteMultipartUpload',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
            ),
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'Parts' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'CompletedPart',
                        'type' => 'object',
                        'sentAs' => 'Part',
                        'properties' => array(
                            'ETag' => array(
                                'type' => 'string',
                            ),
                            'PartNumber' => array(
                                'type' => 'numeric',
                            ),
                        ),
                    ),
                ),
                'UploadId' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'uploadId',
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'CopyObject' => array(
            'httpMethod' => 'PUT',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'CopyObjectOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTObjectCOPY.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'CopyObjectRequest',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
            ),
            'parameters' => array(
                'ACL' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-acl',
                ),
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'CacheControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Cache-Control',
                ),
                'ContentDisposition' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Disposition',
                ),
                'ContentEncoding' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Encoding',
                ),
                'ContentLanguage' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Language',
                ),
                'ContentType' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Type',
                ),
                'CopySource' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-copy-source',
                ),
                'CopySourceIfMatch' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-copy-source-if-match',
                ),
                'CopySourceIfModifiedSince' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                    'sentAs' => 'x-amz-copy-source-if-modified-since',
                ),
                'CopySourceIfNoneMatch' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-copy-source-if-none-match',
                ),
                'CopySourceIfUnmodifiedSince' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                    'sentAs' => 'x-amz-copy-source-if-unmodified-since',
                ),
                'Expires' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                ),
                'GrantFullControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-full-control',
                ),
                'GrantRead' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read',
                ),
                'GrantReadACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read-acp',
                ),
                'GrantWriteACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write-acp',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'Metadata' => array(
                    'type' => 'object',
                    'location' => 'header',
                    'sentAs' => 'x-amz-meta-',
                    'additionalProperties' => array(
                        'type' => 'string',
                    ),
                ),
                'MetadataDirective' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-metadata-directive',
                ),
                'ServerSideEncryption' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption',
                ),
                'StorageClass' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-storage-class',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The source object of the COPY operation is not in the active tier and is only stored in Amazon Glacier.',
                    'class' => 'ObjectNotInActiveTierErrorException',
                ),
            ),
        ),
        'CreateBucket' => array(
            'httpMethod' => 'PUT',
            'uri' => '/{Bucket}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'CreateBucketOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketPUT.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'CreateBucketConfiguration',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
            ),
            'parameters' => array(
                'ACL' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-acl',
                ),
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'LocationConstraint' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'GrantFullControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-full-control',
                ),
                'GrantRead' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read',
                ),
                'GrantWrite' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write',
                ),
                'GrantWriteACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write-acp',
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The requested bucket name is not available. The bucket namespace is shared by all users of the system. Please select a different name and try again.',
                    'class' => 'BucketAlreadyExistsException',
                ),
            ),
        ),
        'CreateMultipartUpload' => array(
            'httpMethod' => 'POST',
            'uri' => '/{Bucket}{/Key*}?uploads',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'CreateMultipartUploadOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/mpUploadInitiate.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'CreateMultipartUploadRequest',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
            ),
            'parameters' => array(
                'ACL' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-acl',
                ),
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'CacheControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Cache-Control',
                ),
                'ContentDisposition' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Disposition',
                ),
                'ContentEncoding' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Encoding',
                ),
                'ContentLanguage' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Language',
                ),
                'ContentType' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Type',
                ),
                'Expires' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                ),
                'GrantFullControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-full-control',
                ),
                'GrantRead' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read',
                ),
                'GrantReadACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read-acp',
                ),
                'GrantWriteACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write-acp',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'Metadata' => array(
                    'type' => 'object',
                    'location' => 'header',
                    'sentAs' => 'x-amz-meta-',
                    'additionalProperties' => array(
                        'type' => 'string',
                    ),
                ),
                'ServerSideEncryption' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption',
                ),
                'StorageClass' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-storage-class',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'DeleteBucket' => array(
            'httpMethod' => 'DELETE',
            'uri' => '/{Bucket}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'DeleteBucketOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketDELETE.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
            ),
        ),
        'DeleteObject' => array(
            'httpMethod' => 'DELETE',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'DeleteObjectOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTObjectDELETE.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'MFA' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-mfa',
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'versionId',
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
            ),
        ),
        'DeleteObjects' => array(
            'httpMethod' => 'POST',
            'uri' => '/{Bucket}?delete',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'DeleteObjectsOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/multiobjectdeleteapi.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'Delete',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
                'contentMd5' => true,
            ),
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Objects' => array(
                    'required' => true,
                    'type' => 'array',
                    'location' => 'xml',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'ObjectIdentifier',
                        'type' => 'object',
                        'sentAs' => 'Object',
                        'properties' => array(
                            'Key' => array(
                                'required' => true,
                                'type' => 'string',
                            ),
                            'VersionId' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'Quiet' => array(
                    'type' => 'boolean',
                    'format' => 'boolean-string',
                    'location' => 'xml',
                ),
                'MFA' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-mfa',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'GetBucketAcl' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}?acl',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'GetBucketAclOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketGETacl.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'GetBucketCors' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}?cors',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'GetBucketCorsOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketGETcors.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'GetBucketLocation' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}?location',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'GetBucketLocationOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketGETlocation.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
            ),
        ),
        'GetBucketLogging' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}?logging',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'GetBucketLoggingOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketGETlogging.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'GetBucketVersioning' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}?versioning',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'GetBucketVersioningOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketGETversioningStatus.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'GetObject' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'GetObjectOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTObjectGET.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'IfMatch' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'If-Match',
                ),
                'IfModifiedSince' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                    'sentAs' => 'If-Modified-Since',
                ),
                'IfNoneMatch' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'If-None-Match',
                ),
                'IfUnmodifiedSince' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                    'sentAs' => 'If-Unmodified-Since',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'Range' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'ResponseCacheControl' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'response-cache-control',
                ),
                'ResponseContentDisposition' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'response-content-disposition',
                ),
                'ResponseContentEncoding' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'response-content-encoding',
                ),
                'ResponseContentLanguage' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'response-content-language',
                ),
                'ResponseContentType' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'response-content-type',
                ),
                'ResponseExpires' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'query',
                    'sentAs' => 'response-expires',
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'versionId',
                ),
                'SSECustomerAlgorithm' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-algorithm',
                ),
                'SSECustomerKey' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-key',
                ),
                'SSECustomerKeyMD5' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-key-MD5',
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
                'SaveAs' => array(
                    'location' => 'response_body',
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The specified key does not exist.',
                    'class' => 'NoSuchKeyException',
                ),
            ),
        ),
        'GetObjectAcl' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}{/Key*}?acl',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'GetObjectAclOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTObjectGETacl.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'versionId',
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The specified key does not exist.',
                    'class' => 'NoSuchKeyException',
                ),
            ),
        ),
        'HeadBucket' => array(
            'httpMethod' => 'HEAD',
            'uri' => '/{Bucket}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'HeadBucketOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketHEAD.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The specified bucket does not exist.',
                    'class' => 'NoSuchBucketException',
                ),
            ),
        ),
        'HeadObject' => array(
            'httpMethod' => 'HEAD',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'HeadObjectOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTObjectHEAD.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'IfMatch' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'If-Match',
                ),
                'IfModifiedSince' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                    'sentAs' => 'If-Modified-Since',
                ),
                'IfNoneMatch' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'If-None-Match',
                ),
                'IfUnmodifiedSince' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                    'sentAs' => 'If-Unmodified-Since',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'Range' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'versionId',
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The specified key does not exist.',
                    'class' => 'NoSuchKeyException',
                ),
            ),
        ),
        'ListBuckets' => array(
            'httpMethod' => 'GET',
            'uri' => '/',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'ListBucketsOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTServiceGET.html',
            'parameters' => array(
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'ListMultipartUploads' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}?uploads',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'ListMultipartUploadsOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/mpUploadListMPUpload.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Delimiter' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'delimiter',
                ),
                'EncodingType' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'encoding-type',
                ),
                'KeyMarker' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'key-marker',
                ),
                'MaxUploads' => array(
                    'type' => 'numeric',
                    'location' => 'query',
                    'sentAs' => 'max-uploads',
                ),
                'Prefix' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'prefix',
                ),
                'UploadIdMarker' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'upload-id-marker',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'ListObjectVersions' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}?versions',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'ListObjectVersionsOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketGETVersion.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Delimiter' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'delimiter',
                ),
                'EncodingType' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'encoding-type',
                ),
                'KeyMarker' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'key-marker',
                ),
                'MaxKeys' => array(
                    'type' => 'numeric',
                    'location' => 'query',
                    'sentAs' => 'max-keys',
                ),
                'Prefix' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'prefix',
                ),
                'VersionIdMarker' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'version-id-marker',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'ListObjects' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'ListObjectsOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketGET.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Delimiter' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'delimiter',
                ),
                'EncodingType' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'encoding-type',
                ),
                'Marker' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'marker',
                ),
                'MaxKeys' => array(
                    'type' => 'numeric',
                    'location' => 'query',
                    'sentAs' => 'max-keys',
                ),
                'Prefix' => array(
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'prefix',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The specified bucket does not exist.',
                    'class' => 'NoSuchBucketException',
                ),
            ),
        ),
        'ListParts' => array(
            'httpMethod' => 'GET',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'ListPartsOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/mpUploadListParts.html',
            'parameters' => array(
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'MaxParts' => array(
                    'type' => 'numeric',
                    'location' => 'query',
                    'sentAs' => 'max-parts',
                ),
                'PartNumberMarker' => array(
                    'type' => 'numeric',
                    'location' => 'query',
                    'sentAs' => 'part-number-marker',
                ),
                'UploadId' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'uploadId',
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
                'command.expects' => array(
                    'static' => true,
                    'default' => 'application/xml',
                ),
            ),
        ),
        'PutBucketAcl' => array(
            'httpMethod' => 'PUT',
            'uri' => '/{Bucket}?acl',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'PutBucketAclOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTBucketPUTacl.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'AccessControlPolicy',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
            ),
            'parameters' => array(
                'ACL' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-acl',
                ),
                'Grants' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'AccessControlList',
                    'items' => array(
                        'name' => 'Grant',
                        'type' => 'object',
                        'properties' => array(
                            'Grantee' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                    'EmailAddress' => array(
                                        'type' => 'string',
                                    ),
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                    'Type' => array(
                                        'required' => true,
                                        'type' => 'string',
                                        'sentAs' => 'xsi:type',
                                        'data' => array(
                                            'xmlAttribute' => true,
                                            'xmlNamespace' => 'http://www.w3.org/2001/XMLSchema-instance',
                                        ),
                                    ),
                                    'URI' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                            'Permission' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'Owner' => array(
                    'type' => 'object',
                    'location' => 'xml',
                    'properties' => array(
                        'DisplayName' => array(
                            'type' => 'string',
                        ),
                        'ID' => array(
                            'type' => 'string',
                        ),
                    ),
                ),
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'GrantFullControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-full-control',
                ),
                'GrantRead' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read',
                ),
                'GrantReadACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read-acp',
                ),
                'GrantWrite' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write',
                ),
                'GrantWriteACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write-acp',
                ),
                'ACP' => array(
                    'type' => 'object',
                    'additionalProperties' => true,
                ),
            ),
        ),
        'PutObject' => array(
            'httpMethod' => 'PUT',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'PutObjectOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTObjectPUT.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'PutObjectRequest',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
            ),
            'parameters' => array(
                'ACL' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-acl',
                ),
                'Body' => array(
                    'type' => array(
                        'string',
                        'object',
                    ),
                    'location' => 'body',
                ),
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'CacheControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Cache-Control',
                ),
                'ContentDisposition' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Disposition',
                ),
                'ContentEncoding' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Encoding',
                ),
                'ContentLanguage' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Language',
                ),
                'ContentLength' => array(
                    'type' => 'numeric',
                    'location' => 'header',
                    'sentAs' => 'Content-Length',
                ),
                'ContentMD5' => array(
                    'type' => array(
                        'string',
                        'boolean',
                    ),
                    'location' => 'header',
                    'sentAs' => 'Content-MD5',
                ),
                'ContentType' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Type',
                ),
                'Expires' => array(
                    'type' => array(
                        'object',
                        'string',
                        'integer',
                    ),
                    'format' => 'date-time-http',
                    'location' => 'header',
                ),
                'GrantFullControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-full-control',
                ),
                'GrantRead' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read',
                ),
                'GrantReadACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read-acp',
                ),
                'GrantWriteACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write-acp',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'Metadata' => array(
                    'type' => 'object',
                    'location' => 'header',
                    'sentAs' => 'x-amz-meta-',
                    'additionalProperties' => array(
                        'type' => 'string',
                    ),
                ),
                'StorageClass' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-storage-class',
                ),
            ),
        ),
        'PutObjectAcl' => array(
            'httpMethod' => 'PUT',
            'uri' => '/{Bucket}{/Key*}?acl',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'PutObjectAclOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/RESTObjectPUTacl.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'AccessControlPolicy',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
            ),
            'parameters' => array(
                'ACL' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-acl',
                ),
                'Grants' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'AccessControlList',
                    'items' => array(
                        'name' => 'Grant',
                        'type' => 'object',
                        'properties' => array(
                            'Grantee' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                    'EmailAddress' => array(
                                        'type' => 'string',
                                    ),
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                    'Type' => array(
                                        'required' => true,
                                        'type' => 'string',
                                        'sentAs' => 'xsi:type',
                                        'data' => array(
                                            'xmlAttribute' => true,
                                            'xmlNamespace' => 'http://www.w3.org/2001/XMLSchema-instance',
                                        ),
                                    ),
                                    'URI' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                            'Permission' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'Owner' => array(
                    'type' => 'object',
                    'location' => 'xml',
                    'properties' => array(
                        'DisplayName' => array(
                            'type' => 'string',
                        ),
                        'ID' => array(
                            'type' => 'string',
                        ),
                    ),
                ),
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'GrantFullControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-full-control',
                ),
                'GrantRead' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read',
                ),
                'GrantReadACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-read-acp',
                ),
                'GrantWrite' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write',
                ),
                'GrantWriteACP' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-grant-write-acp',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
                'ACP' => array(
                    'type' => 'object',
                    'additionalProperties' => true,
                ),
            ),
            'errorResponses' => array(
                array(
                    'reason' => 'The specified key does not exist.',
                    'class' => 'NoSuchKeyException',
                ),
            ),
        ),
        'UploadPart' => array(
            'httpMethod' => 'PUT',
            'uri' => '/{Bucket}{/Key*}',
            'class' => 'Mss\\S3\\Command\\S3Command',
            'responseClass' => 'UploadPartOutput',
            'responseType' => 'model',
            'documentationUrl' => 'http://docs.aws.amazon.com/AmazonS3/latest/API/mpUploadUploadPart.html',
            'data' => array(
                'xmlRoot' => array(
                    'name' => 'UploadPartRequest',
                    'namespaces' => array(
                        'http://s3.amazonaws.com/doc/2006-03-01/',
                    ),
                ),
            ),
            'parameters' => array(
                'Body' => array(
                    'type' => array(
                        'string',
                        'object',
                    ),
                    'location' => 'body',
                ),
                'Bucket' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                ),
                'ContentLength' => array(
                    'type' => 'numeric',
                    'location' => 'header',
                    'sentAs' => 'Content-Length',
                ),
                'ContentMD5' => array(
                    'type' => array(
                        'string',
                        'boolean',
                    ),
                    'location' => 'header',
                    'sentAs' => 'Content-MD5',
                ),
                'Key' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'uri',
                    'filters' => array(
                        'Mss\\S3\\S3Client::explodeKey',
                    ),
                ),
                'PartNumber' => array(
                    'required' => true,
                    'type' => 'numeric',
                    'location' => 'query',
                    'sentAs' => 'partNumber',
                ),
                'UploadId' => array(
                    'required' => true,
                    'type' => 'string',
                    'location' => 'query',
                    'sentAs' => 'uploadId',
                ),
                'SSECustomerAlgorithm' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-algorithm',
                ),
                'SSECustomerKey' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-key',
                ),
                'SSECustomerKeyMD5' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-key-MD5',
                ),
                'RequestPayer' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-payer',
                ),
            ),
        ),
    ),
    'models' => array(
        'AbortMultipartUploadOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'CompleteMultipartUploadOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Location' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Bucket' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Key' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Expiration' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-expiration',
                ),
                'ETag' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'ServerSideEncryption' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption',
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-version-id',
                ),
                'SSEKMSKeyId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-aws-kms-key-id',
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'CreateBucketOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Location' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'CreateMultipartUploadOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Bucket' => array(
                    'type' => 'string',
                    'location' => 'xml',
                    'sentAs' => 'Bucket',
                ),
                'Key' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'UploadId' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'DeleteBucketOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'DeleteBucketCorsOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'DeleteObjectOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'DeleteMarker' => array(
                    'type' => 'boolean',
                    'location' => 'header',
                    'sentAs' => 'x-amz-delete-marker',
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-version-id',
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'DeleteObjectsOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Deleted' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'DeletedObject',
                        'type' => 'object',
                        'properties' => array(
                            'Key' => array(
                                'type' => 'string',
                            ),
                            'VersionId' => array(
                                'type' => 'string',
                            ),
                            'DeleteMarker' => array(
                                'type' => 'boolean',
                            ),
                            'DeleteMarkerVersionId' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'Errors' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'Error',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'Error',
                        'type' => 'object',
                        'sentAs' => 'Error',
                        'properties' => array(
                            'Key' => array(
                                'type' => 'string',
                            ),
                            'VersionId' => array(
                                'type' => 'string',
                            ),
                            'Code' => array(
                                'type' => 'string',
                            ),
                            'Message' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'GetBucketAclOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Owner' => array(
                    'type' => 'object',
                    'location' => 'xml',
                    'properties' => array(
                        'DisplayName' => array(
                            'type' => 'string',
                        ),
                        'ID' => array(
                            'type' => 'string',
                        ),
                    ),
                ),
                'Grants' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'AccessControlList',
                    'items' => array(
                        'name' => 'Grant',
                        'type' => 'object',
                        'sentAs' => 'Grant',
                        'properties' => array(
                            'Grantee' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                    'EmailAddress' => array(
                                        'type' => 'string',
                                    ),
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                    'Type' => array(
                                        'type' => 'string',
                                        'sentAs' => 'xsi:type',
                                        'data' => array(
                                            'xmlAttribute' => true,
                                            'xmlNamespace' => 'http://www.w3.org/2001/XMLSchema-instance',
                                        ),
                                    ),
                                    'URI' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                            'Permission' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'GetBucketVersioningOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Status' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'MFADelete' => array(
                    'type' => 'string',
                    'location' => 'xml',
                    'sentAs' => 'MfaDelete',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'GetObjectOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Body' => array(
                    'type' => 'string',
                    'instanceOf' => 'Guzzle\\Http\\EntityBody',
                    'location' => 'body',
                ),
                'DeleteMarker' => array(
                    'type' => 'boolean',
                    'location' => 'header',
                    'sentAs' => 'x-amz-delete-marker',
                ),
                'AcceptRanges' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'accept-ranges',
                ),
                'Expiration' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-expiration',
                ),
                'Restore' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-restore',
                ),
                'LastModified' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Last-Modified',
                ),
                'ContentLength' => array(
                    'type' => 'numeric',
                    'location' => 'header',
                    'sentAs' => 'Content-Length',
                ),
                'ETag' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'MissingMeta' => array(
                    'type' => 'numeric',
                    'location' => 'header',
                    'sentAs' => 'x-amz-missing-meta',
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-version-id',
                ),
                'CacheControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Cache-Control',
                ),
                'ContentDisposition' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Disposition',
                ),
                'ContentEncoding' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Encoding',
                ),
                'ContentLanguage' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Language',
                ),
                'ContentType' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Type',
                ),
                'Expires' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'WebsiteRedirectLocation' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-website-redirect-location',
                ),
                'ServerSideEncryption' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption',
                ),
                'Metadata' => array(
                    'type' => 'object',
                    'location' => 'header',
                    'sentAs' => 'x-amz-meta-',
                    'additionalProperties' => array(
                        'type' => 'string',
                    ),
                ),
                'SSECustomerAlgorithm' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-algorithm',
                ),
                'SSECustomerKeyMD5' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-key-MD5',
                ),
                'SSEKMSKeyId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-aws-kms-key-id',
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'ReplicationStatus' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-replication-status',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'GetObjectAclOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Owner' => array(
                    'type' => 'object',
                    'location' => 'xml',
                    'properties' => array(
                        'DisplayName' => array(
                            'type' => 'string',
                        ),
                        'ID' => array(
                            'type' => 'string',
                        ),
                    ),
                ),
                'Grants' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'AccessControlList',
                    'items' => array(
                        'name' => 'Grant',
                        'type' => 'object',
                        'sentAs' => 'Grant',
                        'properties' => array(
                            'Grantee' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                    'EmailAddress' => array(
                                        'type' => 'string',
                                    ),
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                    'Type' => array(
                                        'type' => 'string',
                                        'sentAs' => 'xsi:type',
                                        'data' => array(
                                            'xmlAttribute' => true,
                                            'xmlNamespace' => 'http://www.w3.org/2001/XMLSchema-instance',
                                        ),
                                    ),
                                    'URI' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                            'Permission' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'HeadBucketOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'HeadObjectOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'DeleteMarker' => array(
                    'type' => 'boolean',
                    'location' => 'header',
                    'sentAs' => 'x-amz-delete-marker',
                ),
                'AcceptRanges' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'accept-ranges',
                ),
                'Expiration' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-expiration',
                ),
                'Restore' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-restore',
                ),
                'LastModified' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Last-Modified',
                ),
                'ContentLength' => array(
                    'type' => 'numeric',
                    'location' => 'header',
                    'sentAs' => 'Content-Length',
                ),
                'ETag' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'MissingMeta' => array(
                    'type' => 'numeric',
                    'location' => 'header',
                    'sentAs' => 'x-amz-missing-meta',
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-version-id',
                ),
                'CacheControl' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Cache-Control',
                ),
                'ContentDisposition' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Disposition',
                ),
                'ContentEncoding' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Encoding',
                ),
                'ContentLanguage' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Language',
                ),
                'ContentType' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'Content-Type',
                ),
                'Expires' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'WebsiteRedirectLocation' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-website-redirect-location',
                ),
                'ServerSideEncryption' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption',
                ),
                'Metadata' => array(
                    'type' => 'object',
                    'location' => 'header',
                    'sentAs' => 'x-amz-meta-',
                    'additionalProperties' => array(
                        'type' => 'string',
                    ),
                ),
                'SSECustomerAlgorithm' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-algorithm',
                ),
                'SSECustomerKeyMD5' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-key-MD5',
                ),
                'SSEKMSKeyId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-aws-kms-key-id',
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'ReplicationStatus' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-replication-status',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'ListBucketsOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Buckets' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'items' => array(
                        'name' => 'Bucket',
                        'type' => 'object',
                        'sentAs' => 'Bucket',
                        'properties' => array(
                            'Name' => array(
                                'type' => 'string',
                            ),
                            'CreationDate' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'Owner' => array(
                    'type' => 'object',
                    'location' => 'xml',
                    'properties' => array(
                        'DisplayName' => array(
                            'type' => 'string',
                        ),
                        'ID' => array(
                            'type' => 'string',
                        ),
                    ),
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'ListMultipartUploadsOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Bucket' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'KeyMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'UploadIdMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'NextKeyMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Prefix' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Delimiter' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'NextUploadIdMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'MaxUploads' => array(
                    'type' => 'numeric',
                    'location' => 'xml',
                ),
                'IsTruncated' => array(
                    'type' => 'boolean',
                    'location' => 'xml',
                ),
                'Uploads' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'Upload',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'MultipartUpload',
                        'type' => 'object',
                        'sentAs' => 'Upload',
                        'properties' => array(
                            'UploadId' => array(
                                'type' => 'string',
                            ),
                            'Key' => array(
                                'type' => 'string',
                            ),
                            'Initiated' => array(
                                'type' => 'string',
                            ),
                            'StorageClass' => array(
                                'type' => 'string',
                            ),
                            'Owner' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                            'Initiator' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'CommonPrefixes' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'CommonPrefix',
                        'type' => 'object',
                        'properties' => array(
                            'Prefix' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'EncodingType' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'ListObjectVersionsOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'IsTruncated' => array(
                    'type' => 'boolean',
                    'location' => 'xml',
                ),
                'KeyMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'VersionIdMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'NextKeyMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'NextVersionIdMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Versions' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'Version',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'ObjectVersion',
                        'type' => 'object',
                        'sentAs' => 'Version',
                        'properties' => array(
                            'ETag' => array(
                                'type' => 'string',
                            ),
                            'Size' => array(
                                'type' => 'numeric',
                            ),
                            'StorageClass' => array(
                                'type' => 'string',
                            ),
                            'Key' => array(
                                'type' => 'string',
                            ),
                            'VersionId' => array(
                                'type' => 'string',
                            ),
                            'IsLatest' => array(
                                'type' => 'boolean',
                            ),
                            'LastModified' => array(
                                'type' => 'string',
                            ),
                            'Owner' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'DeleteMarkers' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'DeleteMarker',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'DeleteMarkerEntry',
                        'type' => 'object',
                        'sentAs' => 'DeleteMarker',
                        'properties' => array(
                            'Owner' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                            'Key' => array(
                                'type' => 'string',
                            ),
                            'VersionId' => array(
                                'type' => 'string',
                            ),
                            'IsLatest' => array(
                                'type' => 'boolean',
                            ),
                            'LastModified' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'Name' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Prefix' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Delimiter' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'MaxKeys' => array(
                    'type' => 'numeric',
                    'location' => 'xml',
                ),
                'CommonPrefixes' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'CommonPrefix',
                        'type' => 'object',
                        'properties' => array(
                            'Prefix' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'EncodingType' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'ListObjectsOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'IsTruncated' => array(
                    'type' => 'boolean',
                    'location' => 'xml',
                ),
                'Marker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'NextMarker' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Contents' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'Object',
                        'type' => 'object',
                        'properties' => array(
                            'Key' => array(
                                'type' => 'string',
                            ),
                            'LastModified' => array(
                                'type' => 'string',
                            ),
                            'ETag' => array(
                                'type' => 'string',
                            ),
                            'Size' => array(
                                'type' => 'numeric',
                            ),
                            'StorageClass' => array(
                                'type' => 'string',
                            ),
                            'Owner' => array(
                                'type' => 'object',
                                'properties' => array(
                                    'DisplayName' => array(
                                        'type' => 'string',
                                    ),
                                    'ID' => array(
                                        'type' => 'string',
                                    ),
                                ),
                            ),
                        ),
                    ),
                ),
                'Name' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Prefix' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Delimiter' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'MaxKeys' => array(
                    'type' => 'numeric',
                    'location' => 'xml',
                ),
                'CommonPrefixes' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'CommonPrefix',
                        'type' => 'object',
                        'properties' => array(
                            'Prefix' => array(
                                'type' => 'string',
                            ),
                        ),
                    ),
                ),
                'EncodingType' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'ListPartsOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Bucket' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'Key' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'UploadId' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'PartNumberMarker' => array(
                    'type' => 'numeric',
                    'location' => 'xml',
                ),
                'NextPartNumberMarker' => array(
                    'type' => 'numeric',
                    'location' => 'xml',
                ),
                'MaxParts' => array(
                    'type' => 'numeric',
                    'location' => 'xml',
                ),
                'IsTruncated' => array(
                    'type' => 'boolean',
                    'location' => 'xml',
                ),
                'Parts' => array(
                    'type' => 'array',
                    'location' => 'xml',
                    'sentAs' => 'Part',
                    'data' => array(
                        'xmlFlattened' => true,
                    ),
                    'items' => array(
                        'name' => 'Part',
                        'type' => 'object',
                        'sentAs' => 'Part',
                        'properties' => array(
                            'PartNumber' => array(
                                'type' => 'numeric',
                            ),
                            'LastModified' => array(
                                'type' => 'string',
                            ),
                            'ETag' => array(
                                'type' => 'string',
                            ),
                            'Size' => array(
                                'type' => 'numeric',
                            ),
                        ),
                    ),
                ),
                'Initiator' => array(
                    'type' => 'object',
                    'location' => 'xml',
                    'properties' => array(
                        'ID' => array(
                            'type' => 'string',
                        ),
                        'DisplayName' => array(
                            'type' => 'string',
                        ),
                    ),
                ),
                'Owner' => array(
                    'type' => 'object',
                    'location' => 'xml',
                    'properties' => array(
                        'DisplayName' => array(
                            'type' => 'string',
                        ),
                        'ID' => array(
                            'type' => 'string',
                        ),
                    ),
                ),
                'StorageClass' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'PutBucketAclOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'PutBucketNotificationOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'PutObjectOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'Expiration' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-expiration',
                ),
                'ETag' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'ServerSideEncryption' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption',
                ),
                'VersionId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-version-id',
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
                'ObjectURL' => array(
                ),
            ),
        ),
        'PutObjectAclOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'UploadPartOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'ServerSideEncryption' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption',
                ),
                'ETag' => array(
                    'type' => 'string',
                    'location' => 'header',
                ),
                'SSECustomerAlgorithm' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-algorithm',
                ),
                'SSECustomerKeyMD5' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-key-MD5',
                ),
                'SSEKMSKeyId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-aws-kms-key-id',
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
        'UploadPartCopyOutput' => array(
            'type' => 'object',
            'additionalProperties' => true,
            'properties' => array(
                'CopySourceVersionId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-copy-source-version-id',
                ),
                'ETag' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'LastModified' => array(
                    'type' => 'string',
                    'location' => 'xml',
                ),
                'ServerSideEncryption' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption',
                ),
                'SSECustomerAlgorithm' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-algorithm',
                ),
                'SSECustomerKeyMD5' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-customer-key-MD5',
                ),
                'SSEKMSKeyId' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-server-side-encryption-aws-kms-key-id',
                ),
                'RequestCharged' => array(
                    'type' => 'string',
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-charged',
                ),
                'RequestId' => array(
                    'location' => 'header',
                    'sentAs' => 'x-amz-request-id',
                ),
            ),
        ),
    ),
    'iterators' => array(
        'ListBuckets' => array(
            'result_key' => 'Buckets',
        ),
        'ListMultipartUploads' => array(
            'limit_key' => 'MaxUploads',
            'more_results' => 'IsTruncated',
            'output_token' => array(
                'NextKeyMarker',
                'NextUploadIdMarker',
            ),
            'input_token' => array(
                'KeyMarker',
                'UploadIdMarker',
            ),
            'result_key' => array(
                'Uploads',
                'CommonPrefixes',
            ),
        ),
        'ListObjectVersions' => array(
            'more_results' => 'IsTruncated',
            'limit_key' => 'MaxKeys',
            'output_token' => array(
                'NextKeyMarker',
                'NextVersionIdMarker',
            ),
            'input_token' => array(
                'KeyMarker',
                'VersionIdMarker',
            ),
            'result_key' => array(
                'Versions',
                'DeleteMarkers',
                'CommonPrefixes',
            ),
        ),
        'ListObjects' => array(
            'more_results' => 'IsTruncated',
            'limit_key' => 'MaxKeys',
            'output_token' => 'NextMarker',
            'input_token' => 'Marker',
            'result_key' => array(
                'Contents',
                'CommonPrefixes',
            ),
        ),
        'ListParts' => array(
            'more_results' => 'IsTruncated',
            'limit_key' => 'MaxParts',
            'output_token' => 'NextPartNumberMarker',
            'input_token' => 'PartNumberMarker',
            'result_key' => 'Parts',
        ),
    ),
    'waiters' => array(
        '__default__' => array(
            'interval' => 5,
            'max_attempts' => 20,
        ),
        'BucketExists' => array(
            'operation' => 'HeadBucket',
            'success.type' => 'output',
            'ignore_errors' => array(
                'NoSuchBucket',
            ),
        ),
        'BucketNotExists' => array(
            'operation' => 'HeadBucket',
            'success.type' => 'error',
            'success.value' => 'NoSuchBucket',
        ),
        'ObjectExists' => array(
            'operation' => 'HeadObject',
            'success.type' => 'output',
            'ignore_errors' => array(
                'NoSuchKey',
            ),
        ),
    ),
);
