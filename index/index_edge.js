/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='images/',
        aud='media/',
        vid='media/',
        js='js/',
        fonts = {
            'source-sans-pro, sans-serif': '<script src=\"http://use.edgefonts.net/source-sans-pro:n4,n9,n7,i7,i4,n3,i3,n6,i6,i9,n2,i2:all.js\"></script>',
            'supermarket': '<link rel=\"stylesheet\" href=\"myStyleX.css\" type=\"text/css\" media=\"screen\" title=\"\"charset = \"utf-8\"/>'        },
        opts = {
            'gAudioPreloadPreference': 'auto',
            'gVideoPreloadPreference': 'auto'
        },
        resources = [
        ],
        scripts = [
            js+"jquery-2.2.1.js"
        ],
        symbols = {
            "stage": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'content',
                            type: 'rect',
                            rect: ['158px', '204px', '861px', '428px', 'auto', 'auto'],
                            overflow: 'auto',
                            fill: ["rgba(192,192,192,0.00)"],
                            stroke: [1,"rgba(82,82,82,1.00)","none"]
                        },
                        {
                            id: 'maya',
                            type: 'text',
                            rect: ['14px', '15px', '861px', '396px', 'auto', 'auto'],
                            text: "<p style=\"margin: 0px;\">​XXXXXXXX</p>",
                            align: "left",
                            font: ['Arial, Helvetica, sans-serif', [24, ""], "rgba(255,159,0,1.00)", "normal", "none", "", "break-word", "normal"]
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '900px', '450px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(228,221,0,1.00)"]
                        }
                    }
                },
                timeline: {
                    duration: 0,
                    autoPlay: true,
                    data: [

                    ]
                }
            },
            "template": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            rect: ['845px', '7px', '660px', '67px', 'auto', 'auto'],
                            borderRadius: ['11px', '11px', '11px', '11px 11px'],
                            id: 'Rectangle2',
                            stroke: [1, 'rgb(82, 82, 82)', 'none'],
                            type: 'rect',
                            fill: ['rgba(255,255,255,1.00)']
                        },
                        {
                            transform: [[], ['45'], [0, 0, 0], [1, 1, 1]],
                            rect: ['840px', '32px', '19px', '19px', 'auto', 'auto'],
                            id: 'Rectangle3',
                            stroke: [1, 'rgb(82, 82, 82)', 'none'],
                            type: 'rect',
                            fill: ['rgba(255,255,255,1)']
                        },
                        {
                            type: 'text',
                            rect: ['119px', '10px', '56px', '52px', 'auto', 'auto'],
                            text: '<p style=\"margin: 0px; text-align: center;\">​<span style=\"font-weight: 900; font-size: 43px; color: rgb(168, 168, 168);\">99</span></p>',
                            opacity: '0',
                            align: 'center',
                            textStyle: ['', '', '', '', 'none'],
                            id: 'num',
                            font: ['source-sans-pro, sans-serif', [43, 'px'], 'rgba(146,146,146,1.00)', '600', 'none', 'normal', 'break-word', 'normal']
                        },
                        {
                            font: ['source-sans-pro, sans-serif', [20, 'px'], 'rgba(0,117,235,1.00)', '600', 'none', '', 'break-word', 'normal'],
                            type: 'text',
                            id: 't1',
                            opacity: '0',
                            text: '<p style=\"margin: 0px;\">​Text A<span style=\"font-family: source-sans-pro, sans-serif;\">​</span></p>',
                            rect: ['191px', '11px', '553px', '29px', 'auto', 'auto']
                        },
                        {
                            font: ['supermarket', [22, 'px'], 'rgba(134,134,134,1.00)', '300', 'none', 'normal', 'break-word', 'normal'],
                            type: 'text',
                            id: 't2',
                            opacity: '0',
                            text: '<p style=\"margin: 0px;\">ภาษาไทย</p>',
                            rect: ['191px', '34px', '553px', '29px', 'auto', 'auto']
                        },
                        {
                            type: 'rect',
                            id: 'mc',
                            stroke: [1, 'rgb(82, 82, 82)', 'none'],
                            rect: ['-85px', '6px', '70px', '70px', 'auto', 'auto'],
                            fill: ['rgba(67,67,67,1.00)']
                        }
                    ],
                    style: {
                        '${symbolSelector}': {
                            overflow: 'hidden',
                            rect: [null, null, '830px', '80px']
                        }
                    }
                },
                timeline: {
                    duration: 5005,
                    autoPlay: false,
                    labels: {
                        "loop": 2130
                    },
                    data: [
                        [
                            "eid23",
                            "top",
                            1210,
                            0,
                            "easeOutBounce",
                            "${Rectangle2}",
                            '7px',
                            '7px'
                        ],
                        [
                            "eid50",
                            "top",
                            3755,
                            0,
                            "linear",
                            "${Rectangle2}",
                            '7px',
                            '7px'
                        ],
                        [
                            "eid82",
                            "top",
                            4255,
                            0,
                            "easeOutCubic",
                            "${Rectangle2}",
                            '7px',
                            '7px'
                        ],
                        [
                            "eid12",
                            "left",
                            0,
                            1210,
                            "easeOutBounce",
                            "${Rectangle2}",
                            '845px',
                            '105px'
                        ],
                        [
                            "eid142",
                            "left",
                            3755,
                            500,
                            "easeOutCubic",
                            "${Rectangle2}",
                            '105px',
                            '146px'
                        ],
                        [
                            "eid143",
                            "left",
                            4255,
                            750,
                            "easeOutCubic",
                            "${Rectangle2}",
                            '146px',
                            '105px'
                        ],
                        [
                            "eid16",
                            "opacity",
                            1630,
                            500,
                            "easeOutCubic",
                            "${t2}",
                            '0',
                            '1'
                        ],
                        [
                            "eid10",
                            "left",
                            0,
                            1210,
                            "easeOutBounce",
                            "${Rectangle3}",
                            '840px',
                            '98px'
                        ],
                        [
                            "eid136",
                            "left",
                            3755,
                            500,
                            "easeOutCubic",
                            "${Rectangle3}",
                            '98px',
                            '139px'
                        ],
                        [
                            "eid137",
                            "left",
                            4255,
                            750,
                            "easeOutCubic",
                            "${Rectangle3}",
                            '139px',
                            '98px'
                        ],
                        [
                            "eid134",
                            "left",
                            3755,
                            500,
                            "easeOutCubic",
                            "${num}",
                            '119px',
                            '160px'
                        ],
                        [
                            "eid135",
                            "left",
                            4255,
                            750,
                            "easeOutCubic",
                            "${num}",
                            '160px',
                            '119px'
                        ],
                        [
                            "eid37",
                            "opacity",
                            1000,
                            500,
                            "easeOutCubic",
                            "${num}",
                            '0',
                            '1'
                        ],
                        [
                            "eid24",
                            "top",
                            1210,
                            0,
                            "easeOutBounce",
                            "${Rectangle3}",
                            '32px',
                            '32px'
                        ],
                        [
                            "eid48",
                            "top",
                            3755,
                            0,
                            "linear",
                            "${Rectangle3}",
                            '32px',
                            '32px'
                        ],
                        [
                            "eid83",
                            "top",
                            4255,
                            0,
                            "easeOutCubic",
                            "${Rectangle3}",
                            '32px',
                            '32px'
                        ],
                        [
                            "eid18",
                            "opacity",
                            1210,
                            500,
                            "easeOutCubic",
                            "${t1}",
                            '0',
                            '1'
                        ],
                        [
                            "eid138",
                            "left",
                            3755,
                            500,
                            "easeOutCubic",
                            "${t2}",
                            '191px',
                            '232px'
                        ],
                        [
                            "eid139",
                            "left",
                            4255,
                            750,
                            "easeOutCubic",
                            "${t2}",
                            '232px',
                            '191px'
                        ],
                        [
                            "eid140",
                            "left",
                            3755,
                            500,
                            "easeOutCubic",
                            "${t1}",
                            '191px',
                            '232px'
                        ],
                        [
                            "eid141",
                            "left",
                            4255,
                            750,
                            "easeOutCubic",
                            "${t1}",
                            '232px',
                            '191px'
                        ],
                        [
                            "eid30",
                            "left",
                            0,
                            750,
                            "easeOutCubic",
                            "${mc}",
                            '-85px',
                            '18px'
                        ],
                        [
                            "eid146",
                            "left",
                            3500,
                            355,
                            "easeOutCubic",
                            "${mc}",
                            '18px',
                            '38px'
                        ],
                        [
                            "eid147",
                            "left",
                            3855,
                            400,
                            "easeOutCubic",
                            "${mc}",
                            '38px',
                            '18px'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("index_edgeActions.js");
})("EDGE-13749049");
