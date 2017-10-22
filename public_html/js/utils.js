
function searchParamsToObject() {
  var search = location.search.substring(1);
  if (search) {
    return JSON.parse('{"' + decodeURI(search).replace(/"/g, '\\"').replace(/&/g, '","').replace(/=/g,'":"') + '"}');
  }
  return {};
}

function updateParams(params) {
  console.log('Update params', params);
  history.pushState(null, null, location.pathname + '?' + $.param(params))
}
