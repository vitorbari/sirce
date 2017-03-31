$(document).ready(function () {

    //$(".jumbotron").vegas({
    //    overlay: true,
    //    delay: 8000,
    //    shuffle: true,
    //    preload: true,
    //    animation: 'kenburns',
    //    animationDuration: 50000,
    //    slides: [
    //        { src: "/img/background/6a093a9724351b8f41c079656096522f.jpg" },
    //        { src: "/img/background/bee2c3b81114d03878d57793aaf47c27.jpg" }
    //    ]
    //});

    var typeahead_el = $('#home-typeahead');

    if(typeahead_el.length) {

        var genericSearch = function searchType(type) {
            return new Bloodhound({
                datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
                queryTokenizer: Bloodhound.tokenizers.whitespace,
                //prefetch: './data/films/post_1960.json',
                remote: {
                    url: './search/' + type + '/%QUERY',
                    wildcard: '%QUERY'
                }
            });
        };

        typeahead_el.typeahead({
                hint: false,
                highlight: false,
                minLength: 1
            },
            {
                name: 'sketches',
                source: genericSearch('sketches'),
                displayKey: 'title',
                templates: {
                    header: '<h3>Sketches</h3>',
                    suggestion: Handlebars.compile($("#result-template-sketches").html()),
                    empty: Handlebars.compile($("#empty-template-sketches").html())
                }
            },
            {
                name: 'components',
                source: genericSearch('components'),
                displayKey: 'title',
                templates: {
                    header: '<h3>Components</h3>',
                    suggestion: Handlebars.compile($("#result-template-components").html()),
                    empty: Handlebars.compile($("#empty-template-components").html())
                }
            },
            {
                name: 'boards',
                source: genericSearch('boards'),
                displayKey: 'board',
                templates: {
                    header: '<h3>Boards</h3>',
                    suggestion: Handlebars.compile($("#result-template-boards").html()),
                    empty: Handlebars.compile($("#empty-template-boards").html())
                }
            },
            {
                name: 'mcus',
                source: genericSearch('mcus'),
                displayKey: 'mcu',
                templates: {
                    header: '<h3>MCUs</h3>',
                    suggestion: Handlebars.compile($("#result-template-mcus").html()),
                    empty: Handlebars.compile($("#empty-template-mcus").html())
                }
            },
            {
                name: 'users',
                source: genericSearch('users'),
                displayKey: 'name',
                templates: {
                    header: '<h3>Users</h3>',
                    suggestion: Handlebars.compile($("#result-template-users").html()),
                    empty: Handlebars.compile($("#empty-template-users").html())
                }
            });


        typeahead_el.bind('typeahead:asyncrequest', function (ev, suggestion) {
            $('.typeahead-loading').show();
        });

        typeahead_el.bind('typeahead:asynccancel', function (ev, suggestion) {
            $('.typeahead-loading').hide();
        });

        typeahead_el.bind('typeahead:asyncreceive', function (ev, suggestion) {
            $('.typeahead-loading').hide();
        });

        typeahead_el.bind('typeahead:selected', function (obj, datum) {
            window.location.href = datum.url;
        });

    }



});