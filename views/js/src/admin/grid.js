import Grid from '../../../../../../admin-dev/themes/new-theme/js/components/grid/grid';
import LinkRowActionExtension from '../../../../../../admin-dev/themes/new-theme/js/components/grid/extension/link-row-action-extension';
import SubmitRowActionExtension from '../../../../../../admin-dev/themes/new-theme/js/components/grid/extension/action/row/submit-row-action-extension';
  
const $ = window.$;
  
$(() => {
  const gridDivs = Array.from(document.querySelectorAll('.js-grid'));
  gridDivs.forEach(gridDiv => {
    const grid = new Grid(gridDiv.dataset.gridId);
    grid.addExtension(new LinkRowActionExtension());
    grid.addExtension(new SubmitRowActionExtension());
  });
});
