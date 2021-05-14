import "regenerator-runtime/runtime";
import "core-js/stable";

import RetailersMap from './retailersmap';

window.onload = async function() {
  const response = await fetch(mapDataLink);
  const data = await response.json();
  const { settings, groups, retailers } = data;
  const map = new RetailersMap(settings);
  await map.setUp(groups, retailers);
}
