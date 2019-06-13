define([
    'underscore',
    'jquery',
    'mage/utils/wrapper'
], function (_, $, wrapper) {
    'use strict';

    return function (placeOrderAction) {

      return wrapper.wrap(placeOrderAction, function(originalAction, paymentData, messageContainer) {

          var additionalData = [];
            additionalData['additional_data'] = [];
            additionalData['additional_data'] ['printed-invoice'] =
             $('#printed-invoice').prop('checked');
             console.log(additionalData);

            paymentData = _.extend(paymentData, additionalData);
            return originalAction(paymentData, messageContainer);

        });
    };
});
