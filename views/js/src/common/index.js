import "regenerator-runtime/runtime";
import "core-js/stable";

import RetailersMap from './retailersmap';

window.onload = async function() {
  try {
    const map = new RetailersMap(settings);
    await map.setUp();
  } catch(error) {
    document.querySelector('#map-search-form').style.display = 'none';
    document.querySelector('#retailers-map').style.display = 'none';
    document.querySelector('#map-error').style.display = 'block';
    console.error(error);
  }
}
