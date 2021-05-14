import CountryStateSelectionToggler from '../../../../../../admin-dev/themes/new-theme/js/components/country-state-selection-toggler';

const $ = window.$;

$(document).ready(function () {
  new CountryStateSelectionToggler('#retailer_id_country', '#retailer_id_state', '.js-retailer-state');
});
