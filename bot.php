<?php

/**
 * Copyright 2016 LINE Corporation
 *
 * LINE Corporation licenses this file to you under the Apache License,
 * version 2.0 (the "License"); you may not use this file except in compliance
 * with the License. You may obtain a copy of the License at:
 *
 *   https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations
 * under the License.
 */

require_once('./LINEBotTiny.php');

$channelAccessToken = 'K8EldZ9RU/R3YjfCvEoeBElQC5iGnOTn7F1v5HSRj5raOjipcQY68w9j3kS1J6TaBejAygfwZVZba7yNtzD3Qt8melEBIRbM3MYd700Uoml3hzveszIQKGWqUXEgvgA52gkhbYr1D/HG73SbhqoVdQdB04t89/1O/w1cDnyilFU=' //use your bot channelAccessToken;
$channelSecret = '87fc85c60753450293f9130b96d2cca5'; // use your bot channelSecret

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage(array(
                        'replyToken' => $event['replyToken'],
                        'messages' => array(
                            array(
                                'type' => 'text',
                                'text' => 'Hello your message id is '.$message['id'] // this message will be send to user as replied message
                            )
                        )
                    ));
                    break;
                default:
                    error_log("Unsupporeted message type: " . $message['type']);
                    break;
            }
            break;
        default:
            error_log("Unsupporeted event type: " . $event['type']);
            break;
    }
};