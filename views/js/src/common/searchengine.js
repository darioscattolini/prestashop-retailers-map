export default class SearchEngine {
  #index = {};

  // adds data to search index; won't work for cities/postcodes with same name
  addRetailer(retailer) {
    const city = this.#normalizeString(retailer.city);

    if (!this.#index[city]) {
      this.#index[city] = {
        city: retailer.city,
        retailersCoordinates: []
      };
    }

    this.#index[city].retailersCoordinates.push([
      Number(retailer.latitude), Number(retailer.longitude)
    ]);
    
    const postcode = retailer.postcode;

    if (!this.#index[postcode]) {
      this.#index[postcode] = {
        city: retailer.city,
        retailersCoordinates: []
      };
    }
    
    this.#index[postcode].retailersCoordinates.push([
      Number(retailer.latitude), Number(retailer.longitude)
    ]);
  }

  searchCityOrPostcode(input) {
    input = this.#normalizeString(input);

    const keys = Object.keys(this.#index);
    const foundKeys = keys.filter(key => key.includes(input));
    const foundLocations = [];

    for (const foundKey of foundKeys) {
      const coordinatesSet = this.#index[foundKey].retailersCoordinates;
      const avgCoordinates = this.#calculateAverageCoordinates(coordinatesSet);
      const result = {
        foundKey: foundKey,
        city: this.#index[foundKey].city,
        coordinates: avgCoordinates
      };
      foundLocations.push(result);
    }
    console.log(foundLocations);

    return foundLocations;
  }

  #normalizeString(str) {
    return str.toLowerCase().normalize('NFD').replace(/[\u0300-\u036f]/g, "");
  }

  #calculateAverageCoordinates(coordinatesSet) {
    return coordinatesSet.reduce((avg, cur, ind) => {
      const count = ind + 1;
      const avgLat =  (avg[0] * ind + cur[0]) / count;
      const avgLng =  (avg[1] * ind + cur[1]) / count;
      return [avgLat, avgLng];
    }, [0, 0]);
  }
}