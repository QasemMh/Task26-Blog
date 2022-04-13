$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    fetch("http://localhost:81/task26/api/message?limit=1000")
      .then((response) => response.json())
      .then((data) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
          <th>id</th>
          <th>name</th>
          <th>email</th>
          <th>subject</th>
            <th>Action</th>
          </tr>`;
        let i = 1;
        for (const item of data) {
          tBody += `<tr> 
        <td>${i++}</td>
        <td>${item.name}</td>
        <td>${item.email}</td>
        <td>${item.subject}</td>
          <td> 
         <button class="btn btn-sm btn-info view_item" data-id=${
           item.id
         }>View Message</button>
          <button class="btn btn-sm btn-danger delete_item" data-id=${
            item.id
          }>Delete</button>
          </td>
        </tr>`;
        }

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("User Message", "User Message Data");
      })
      .catch((err) => {
        console.error(err);
      });

    $("#create_item").hide();
  }

  //view message
  $(document).on("click", ".view_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task26/api/message/details/" + id;
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let view_item = `
        <dl class="row">
        <dt class="col-sm-3 text-right">name</dt>
        <dd class="col-sm-9 text-left">${data.name}</dd>

        <dt class="col-sm-3 text-right">email</dt>
        <dd class="col-sm-9 text-left">${data.email}</dd>

        <dt class="col-sm-3 text-right">Message</dt>
        <dd class="col-sm-9 text-left">${data.subject} <br> ${data.message}</dd>
        </dl>  
        
          <!--item-->
          <div class="form-group w-50">
           <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
          </div>
        `;

        $("#app .card-body").html(view_item);
        changePageTitle("View Message");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  //delete
  // will run if the delete button was clicked
  $(document).on("click", ".delete_item", function () {
    let id = $(this).attr("data-id");
    // alert
    Swal.fire({
      title: "Do you want to Delete this?",
      showCancelButton: true,
      confirmButtonText: "Delete",
    }).then((result) => {
      if (result.isConfirmed) {
        fetch("http://localhost:81/task26/api/message/delete/" + id, {
          method: "POST",
        })
          .then((respon) => {
            $(this).parents("tr").fadeOut();
            Swal.fire("Deleted!", "", "success");
          })
          .catch((error) => {
            Swal.fire({
              icon: "error",
              title: "Oops... " + error,
              text: "Something went wrong!",
            });
          });
      }
    });
  });
});
