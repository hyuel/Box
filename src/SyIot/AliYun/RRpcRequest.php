<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
namespace SyIot\AliYun;

use AliOpen\Core\RpcAcsRequest;

class RRpcRequest extends RpcAcsRequest
{
    private $requestBase64Byte;

    private $topic;

    private $deviceName;

    private $productKey;

    private $timeout;
    public function __construct()
    {
        parent::__construct('Iot', '2018-01-20', 'RRpc');
        $this->setMethod('POST');
    }

    public function getRequestBase64Byte()
    {
        return $this->requestBase64Byte;
    }

    public function setRequestBase64Byte($requestBase64Byte)
    {
        $this->requestBase64Byte = $requestBase64Byte;
        $this->queryParameters['RequestBase64Byte'] = $requestBase64Byte;
    }

    public function getTopic()
    {
        return $this->topic;
    }

    public function setTopic($topic)
    {
        $this->topic = $topic;
        $this->queryParameters['Topic'] = $topic;
    }

    public function getDeviceName()
    {
        return $this->deviceName;
    }

    public function setDeviceName($deviceName)
    {
        $this->deviceName = $deviceName;
        $this->queryParameters['DeviceName'] = $deviceName;
    }

    public function getProductKey()
    {
        return $this->productKey;
    }

    public function setProductKey($productKey)
    {
        $this->productKey = $productKey;
        $this->queryParameters['ProductKey'] = $productKey;
    }

    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;
        $this->queryParameters['Timeout'] = $timeout;
    }
}
