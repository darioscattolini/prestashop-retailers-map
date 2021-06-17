<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
  integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
  crossorigin=""/>

<link rel="stylesheet" href="{$stylesheetLink}" />
  
<div class="map-container">
  <div class="search-bar-container">
    <form id="map-search-form" onsubmit="event.preventDefault();" role="search">
      <label for="search">{$searchPlaceholder}</label>
      <input type="search" placeholder="{$searchPlaceholder}" autofocus required>
      <button type="submit"><i class="material-icons">search</i></button>
    </form>
    <div id="no-result-alert">{$searchNoResult}</div>
    <div id="many-results-alert">{$searchManyResults}</div>
  </div>
  <div id="retailers-map"></div>
  <div id="map-error" style="display:none;">{$mapError}</div>
</div>

<script>
  const settings = JSON.parse('{$settings}');
</script>
<script src="{$jsLink}"></script>