define(
    [
        'uiComponent',
        'jquery',
        'ko'
    ], function (Component, $, ko) {
        "use strict";

        return Component.extend({
            reviewerName: ko.observable(''),
            reviewerMessage: ko.observable(''),
            isLoading: ko.observable(false),
            url: '',
            initialize: function () {
                this._super();
                this.nextReview();
                return this;
            },
            nextReview: function () {
                this.isLoading(true);
                var self = this;
                $.ajax({
                    url: self.url,
                    type: 'post',
                    dataType: 'json'})
                    .done(function (data) {
                        if(data.name && data.message){
                            self.reviewerName(data.name);
                            self.reviewerMessage(data.message);
                        }
                    }).always(function(){
                        self.isLoading(false);
                });
            }
        });
    });