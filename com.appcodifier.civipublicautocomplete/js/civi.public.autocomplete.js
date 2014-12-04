var CRM = CRM || {};
CRM.$(function ($) {
    $.fn.crmPublicAutocomplete = function (params, options) {
        if (typeof params == 'undefined')
            params = {};
        if (typeof options == 'undefined')
            options = {};
        params = $().extend({
            sequential: 1,
            entity: 'Contact',
            action: 'get'
        }, params);
        var entity = params.entity;
        var action = params.action;
        delete params.entity;
        delete params.action;
        options = $().extend({}, {
            field: 'name',
            skip: ['id', 'contact_id', 'contact_type', 'contact_is_deleted', "email_id", 'address_id', 'country_id'],
            result: function (data) {
                return false;
            },
            formatItem: function (data) {
                return {value: data[options.field], label: data[options.field]};
            },
            addFilters: function (_params, request) {
                if (request.term) {
                    request.term = $.ui.autocomplete.escapeRegex(request.term);
                    _params[options.field] = {"LIKE": "%" + request.term + "%"};
                }
                return _params;
            },
            focus: function (event, ui) {
                return false;
            },
            select: function (event, ui) {
                return true;
            },
            create: function (selector) {
                $(selector).autocomplete('widget').addClass('autocomplete');
            },
            renderItem: false,
            delay: 100,
            width: 250,
            minChars: 1
        }, options);
        return this.each(function () {
            var selector = this;
            var cache = {};
            if (typeof $.fn.autocomplete !== 'function') {
                console.log(typeof $.fn.autocomplete);
                $.fn.autocomplete = cj.fn.autocomplete; //to work around the fubar cj
            }
            $(this).autocomplete({
                source: function (request, response) {
                    var term = request.term;
                    if (term in cache) {
                        response(cache[ term ]);
                        return;
                    }
                    var _params = options.addFilters(params, request);
                    console.log(_params);
                    CRM.api3(entity, action, _params).done(function (result) {
                        var ret = [];
                        if (result.values) {
                            $.each(result.values, function (k, v) {
                                ret.push(options.formatItem(v));
                            });
                        }
                        cache[ term ] = ret;
                        response(ret);
                    });
                },
                focus: function (event, ui) {
                    return options.focus(event, ui);
                },
                select: function (event, ui) {
                    return options.select(event, ui);
                },
                create: function () {
                    options.create(this);
                },
                width: options.width,
                delay: options.delay,
                max: 25,
                dataType: 'json',
                minLength: options.minChars,
                selectFirst: true
            });
            if (typeof options.renderItem === 'function') {
                $(this).autocomplete("instance")._renderItem = options.renderItem;
            }
        });
    };
    $('#current_employer').crmPublicAutocomplete({
        return: 'organization_name,sort_name',
        contact_type: 'Organization',
        options: {sort: 'sort_name'}
    }, {
        field: 'organization_name',
        minChars: 3,
        focus: function (event, ui) {
            $('#current_employer').val(ui.item.label);
            return false;
        }
    });
});
