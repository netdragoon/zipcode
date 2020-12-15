<?php

namespace Canducci\ZipCode;

class ZipCodeResponse
{

    /**
     * @var array
     */
    private $httpResponse;
    /*
     * @var $json
     */
    private $json;

    /**
     * 
     * @param string $json
     * @param array $httpResponse
     */
    public function __construct(string $json, array $httpResponse)
    {
        $this->json = $json;
        $this->httpResponse = $httpResponse;
    }

    /**
     * 
     * @return int
     */
    public function getHttpCode(): int
    {
        return $this->httpResponse['http_code'];
    }

    public function isError(): bool
    {
        $array = $this->getArray();
        return isset($array['erro']) && $array['erro'] === true;
    }

    /**
     * @return array
     */
    public function getHttpResponse(): array
    {
        return $this->httpResponse;
    }

    /**
     * 
     * @return string
     */
    public function getJson(): string
    {
        return $this->json;
    }

    /**
     * 
     * @return array
     */
    public function getArray(): array
    {
        return json_decode($this->getJson(), true);
    }

    /**
     * 
     * @return \Canducci\ZipCode\stdClass
     */
    public function getObject(): \stdClass
    {
        return json_decode($this->getJson(), false);
    }

    /**
     * 
     * @return \Canducci\ZipCode\ZipCodeItem
     */
    public function getZipCodeItem(): ZipCodeItem
    {
        return new ZipCodeItem($this->getArray());
    }
}
/*
"url"
"content_type"
"http_code"
"header_size"
"request_size"
"filetime"
"ssl_verify_result"
"redirect_count"
"total_time"
"namelookup_time"
"connect_time"
"pretransfer_time"
"size_upload"
"size_download"
"speed_download"
"speed_upload"
"download_content_length"
"upload_content_length"
"starttransfer_time"
"redirect_time"
"certinfo"
"request_header" (This is only set if the CURLINFO_HEADER_OUT is set by a previous call to curl_setopt())
 */