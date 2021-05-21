import "regenerator-runtime/runtime";
import "core-js/stable";

import RetailersMap from './retailersmap';

window.onload = async function() {
  const map = new RetailersMap(settings);
  await map.setUp();
}
