<?php   
 {
        $quickReply = new QuickReplyMessageBuilder([
            new QuickReplyButtonBuilder(new LocationTemplateActionBuilder('Location')),
        ]);

        $messageTemplate = new TextMessageBuilder('test text1', 'test text2', $quickReply);

        $this->assertEquals(
            [
            [
                'type' => 'text',
                'text' => 'test text1',
            ],
            [
                'type' => 'text',
                'text' => 'test text2',
                'quickReply' => [
                    'items' => [
                        [
                            'type' => 'action',
                            'action' => [
                                "type" => "location",
                                "label" => "Location",
                            ],
                        ],
                    ],
                ],
            ],
            ],
            $messageTemplate->buildMessage()
        );
    }

   function testStickerMessageWithQuickReply()
    {
        $quickReply = new QuickReplyMessageBuilder([
            new QuickReplyButtonBuilder(new CameraTemplateActionBuilder('Camera')),
        ]);

        $messageTemplate = new StickerMessageBuilder('1', '1', $quickReply);

        $this->assertEquals(
            [
            [
                "type" => "sticker",
                "packageId" => "1",
                "stickerId" => "1",
                'quickReply' => [
                    'items' => [
                        [
                            'type' => 'action',
                            'action' => [
                                "type" => "camera",
                                "label" => "Camera",
                            ],
                        ],
                    ],
                ],
            ],
            ],
            $messageTemplate->buildMessage()
        );
    }

     function testImageMessageWithQuickReply()
    {
        $quickReply = new QuickReplyMessageBuilder([
            new QuickReplyButtonBuilder(new CameraRollTemplateActionBuilder('Camera roll')),
        ]);

        $messageTemplate = new ImageMessageBuilder(
            'https://example.com/original.jpg',
            'https://example.com/preview.jpg',
            $quickReply
        );

        $this->assertEquals(
            [
            [
                "type" => "image",
                "originalContentUrl" => "https://example.com/original.jpg",
                "previewImageUrl" => "https://example.com/preview.jpg",
                'quickReply' => [
                    'items' => [
                        [
                            'type' => 'action',
                            'action' => [
                                "type" => "cameraRoll",
                                "label" => "Camera roll",
                            ],
                        ],
                    ],
                ],
            ],
            ],
            $messageTemplate->buildMessage()
        );
    }

    function testVideoMessageWithQuickReply()
    {
        $quickReply = new QuickReplyMessageBuilder([
            new QuickReplyButtonBuilder(new PostbackTemplateActionBuilder('Buy', 'action=buy&itemid=111', 'Buy')),
        ]);

        $messageTemplate = new VideoMessageBuilder(
            'https://example.com/original.mp4',
            'https://example.com/preview.jpg',
            $quickReply
        );

        $this->assertEquals(
            [
            [
                "type" => "video",
                "originalContentUrl" => "https://example.com/original.mp4",
                "previewImageUrl" => "https://example.com/preview.jpg",
                'quickReply' => [
                    'items' => [
                        [
                            'type' => 'action',
                            'action' => [
                                "type" => "postback",
                                "label" => "Buy",
                                "data" => "action=buy&itemid=111",
                                "displayText" => "Buy",
                            ],
                        ],
                    ],
                ],
            ],
            ],
            $messageTemplate->buildMessage()
        );
    }

    function testAudioMessageWithQuickReply()
    {
        $quickReply = new QuickReplyMessageBuilder([
            new QuickReplyButtonBuilder(new DatetimePickerTemplateActionBuilder(
                'Select date',
                'storeId=12345',
                'datetime',
                '2017-12-25t00:00',
                '2018-01-24t23:59',
                '2017-12-25t00:00'
            )),
        ]);

        $messageTemplate = new AudioMessageBuilder('https://example.com/original.m4a', '60000', $quickReply);

        $this->assertEquals(
            [
            [
                "type" => "audio",
                "originalContentUrl" => "https://example.com/original.m4a",
                "duration" => 60000,
                'quickReply' => [
                    'items' => [
                        [
                            'type' => 'action',
                            'action' => [
                                "type" => "datetimepicker",
                                "label" => "Select date",
                                "data" => "storeId=12345",
                                "mode" => "datetime",
                                "initial" => "2017-12-25t00:00",
                                "max" => "2018-01-24t23:59",
                                "min" => "2017-12-25t00:00",
                            ],
                        ],
                    ],
                ],
            ],
            ],
            $messageTemplate->buildMessage()
        );
    }

    function testLocationMessageWithQuickReply()
    {
        $quickReply = new QuickReplyMessageBuilder([
            new QuickReplyButtonBuilder(new DatetimePickerTemplateActionBuilder(
                'Select date',
                'storeId=12345',
                'datetime',
                '2017-12-25t00:00',
                '2018-01-24t23:59',
                '2017-12-25t00:00'
            )),
            new QuickReplyButtonBuilder(new LocationTemplateActionBuilder('Location')),
        ]);

        $messageTemplate = new LocationMessageBuilder(
            'my location',
            '〒150-0002 東京都渋谷区渋谷２丁目２１−１',
            35.65910807942215,
            139.70372892916203,
            $quickReply
        );

        $this->assertEquals(
            [
            [
                "type" => "location",
                "title" => "my location",
                "address" => "〒150-0002 東京都渋谷区渋谷２丁目２１−１",
                "latitude" => 35.65910807942215,
                "longitude" => 139.70372892916203,
                'quickReply' => [
                    'items' => [
                        [
                            'type' => 'action',
                            'action' => [
                                "type" => "datetimepicker",
                                "label" => "Select date",
                                "data" => "storeId=12345",
                                "mode" => "datetime",
                                "initial" => "2017-12-25t00:00",
                                "max" => "2018-01-24t23:59",
                                "min" => "2017-12-25t00:00",
                            ],
                        ],
                        [
                            'type' => 'action',
                            'action' => [
                                "type" => "location",
                                "label" => "Location",
                            ],
                        ],
                    ],
                ],
            ],
            ],
            $messageTemplate->buildMessage()
        );
    }

    function testImagemapMessageWithQuickReply()
    {
        $quickReply = new QuickReplyMessageBuilder([
            new QuickReplyButtonBuilder(new LocationTemplateActionBuilder('Location')),
            new QuickReplyButtonBuilder(new CameraTemplateActionBuilder('Camera')),
        ]);

        $messageTemplate = new ImagemapMessageBuilder(
            'https://example.com/bot/images/rm001',
            'This is an imagemap',
            new BaseSizeBuilder(1040, 1040),
            [
                new ImagemapUriActionBuilder('https://example.com/', new AreaBuilder(0, 0, 520, 1040)),
                new ImagemapMessageActionBuilder('Hello', new AreaBuilder(520, 0, 520, 1040)),
            ],
            $quickReply
        );

        $this->assertEquals(
            [
                [
                    "type" => "imagemap",
                    "baseUrl" => "https://example.com/bot/images/rm001",
                    "altText" => "This is an imagemap",
                    "baseSize" => [
                        "height" => 1040,
                        "width" => 1040,
                    ],
                    "actions" => [
                        [
                            "type" => "uri",
                            "linkUri" => "https://example.com/",
                            "area" => [
                                "x" => 0,
                                "y" => 0,
                                "width" => 520,
                                "height" => 1040,
                            ],
                        ],
                        [
                            "type" => "message",
                            "text" => "Hello",
                            "area" => [
                                "x" => 520,
                                "y" => 0,
                                "width" => 520,
                                "height" => 1040,
                            ],
                        ],
                    ],
                    'quickReply' => [
                        'items' => [
                            [
                                'type' => 'action',
                                'action' => [
                                    "type" => "location",
                                    "label" => "Location",
                                ],
                            ],
                            [
                                'type' => 'action',
                                'action' => [
                                    "type" => "camera",
                                    "label" => "Camera",
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            $messageTemplate->buildMessage()
        );
    }

     function testTemplateMessageWithQuickReply()
    {
        $quickReply = new QuickReplyMessageBuilder([
            new QuickReplyButtonBuilder(new CameraTemplateActionBuilder('Camera')),
            new QuickReplyButtonBuilder(new CameraRollTemplateActionBuilder('Camera roll')),
        ]);

        $messageTemplate = new TemplateMessageBuilder(
            'This is a buttons template',
            new ButtonTemplateBuilder(
                'Menu',
                'Please select',
                'https://example.com/bot/images/image.jpg',
                [
                    new PostbackTemplateActionBuilder('Buy', 'action=buy&itemid=123'),
                    new PostbackTemplateActionBuilder('Add to cart', 'action=add&itemid=123'),
                    new UriTemplateActionBuilder('View detail', 'http://example.com/page/123'),
                ],
                'rectangle',
                'cover',
                '#FFFFFF',
                new UriTemplateActionBuilder('View detail', 'http://example.com/page/123')
            ),
            $quickReply
        );

        $this->assertEquals(
            [
                [
                    "type" => "template",
                    "altText" => "This is a buttons template",
                    "template" => [
                        "type" => "buttons",
                        "thumbnailImageUrl" => "https://example.com/bot/images/image.jpg",
                        "imageAspectRatio" => "rectangle",
                        "imageSize" => "cover",
                        "imageBackgroundColor" => "#FFFFFF",
                        "title" => "Menu",
                        "text" => "Please select",
                        "defaultAction" => [
                            "type" => "uri",
                            "label" => "View detail",
                            "uri" => "http://example.com/page/123",
                        ],
                        "actions" => [
                            [
                                "type" => "postback",
                                "label" => "Buy",
                                "data" => "action=buy&itemid=123",
                            ],
                            [
                                "type" => "postback",
                                "label" => "Add to cart",
                                "data" => "action=add&itemid=123",
                            ],
                            [
                                "type" => "uri",
                                "label" => "View detail",
                                "uri" => "http://example.com/page/123",
                            ],
                        ],
                    ],
                    'quickReply' => [
                        'items' => [
                            [
                                'type' => 'action',
                                'action' => [
                                    "type" => "camera",
                                    "label" => "Camera",
                                ],
                            ],
                            [
                                'type' => 'action',
                                'action' => [
                                    "type" => "cameraRoll",
                                    "label" => "Camera roll",
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            $messageTemplate->buildMessage()
        );
    }


?>