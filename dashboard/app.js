$(document).ready(function () {
  getApp();
});

// change page title
function changePageTitle(page_head, page_title = "Table data") {
  // change page title
  $("#page-title").text(page_title);

  // change title tag
  document.title = page_head;
}

function getApp() {
  // app html
  /*html*/
  let app_html = `
  <div class="card shadow mb-4">
  <div class="card-header py-3">
      <h6 id="#page-title" class="m-0 font-weight-bold text-primary">
       </h6>
      <button class="btn btn-primary mt-4" id="create_item">Create</button>
  </div>
  <div class="card-body">
      <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
              <thead id="table_head">
                  <tr>
                      <th>Data</th>
                  </tr>
              </thead>

              <tbody id="table_body">

              </tbody>
              <tfoot id="table_foot"></tfoot>


          </table>
      </div>
  </div>
</div>
    `;

  // inject to 'app' in index.html
  $("#app").html(app_html);
}
