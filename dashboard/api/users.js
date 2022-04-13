$(function () {
  getAll();

  //Index
  function getAll() {
    getApp();

    fetch("http://localhost:81/task26/api/users?limit=1000")
      .then((response) => response.json())
      .then((data) => {
        let tBody = "",
          tHead = "";
        tHead += `<tr>
      <th>id</th>
      <th>name</th>
      <th>username</th>
      <th>email</th>
      <th>Role</th>
      <th>createAt</th>
       <th>Action</th>
      </tr>`;
        let i = 1;
        for (const item of data) {
          tBody += `<tr> 
    <td>${i++}</td>
    <td>${item.name}</td>
    <td>${item.username}</td>
    <td>${item.email}</td>
    <td>${item.role}</td>
    <td>${item.createAt}</td>
     <td><button class="btn btn-sm btn-info update_item" data-id=${
       item.id
     }>Edit</button>
    <button class="btn btn-sm btn-danger delete_item" data-id=${
      item.id
    }>Delete</button></td>
    </tr>`;

          console.log(item);
        }

        $("#table_head").html(tHead);
        $("#table_body").html(tBody);
        changePageTitle("Users", "User Data");
      })
      .catch((err) => {
        console.error(err);
      });
  }

  //Create
  // show html form when 'create item' button was clicked
  $(document).on("click", "#create_item", function () {
    /*html*/
    let create_form = `
        <form action="" method="POST" id="create_form">
        <div class="form-group">
        <label>Name</label>
        <input  type='text' name='name' class='form-control' required/>
        </div>
        <!--item--> 
        <div class="form-group">
        <label>Username</label>
        <input  type='text' name='username' class='form-control' required/>
        </div>
        <!--item-->  
        <div class="form-group">
        <label>Email</label>
        <input  type='email' name='email' class='form-control' required/>
        </div>
        <!--item-->
         <div class="form-group">
        <label>Password</label>
        <input  type='password' name='password' class='form-control' required/>
        </div>
        <!--item-->
        <div class="form-group w-50">
        <label>Role</label>
        <select name="role_id" class="form-control" required>
        <option value="1">Admin</option>
        <option value="2">User</option>
        </select>
        </div>  
        
        <!--item-->
        <div class="form-group w-50">
        <button  type='submit' class="btn btn-primary" >Submit</button>
        <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
        </div>
        <!--item-->
        
        </form>
        `;

    $("#app .card-body").html(create_form);
    changePageTitle("Create User");
    $("#back-btn").on("click", function () {
      getAll();
    });
  });

  // will run if create  form was submitted
  $(document).on("submit", "#create_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("create_form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });
    form.querySelectorAll("select").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch("http://localhost:81/task26/api/users/create", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        //show all users
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end index

  //update:
  // show html form when 'update user' button was clicked
  $(document).on("click", ".update_item", function () {
    let id = $(this).attr("data-id");
    let uri = "http://localhost:81/task26/api/users/details/" + id;
    fetch(uri)
      .then((response) => response.json())
      .then((data) => {
        /*html*/
        let update_item = `
          <form action="" method="POST" id="update_form">
          <input type="hidden" name="id" value="${data.id}">
          <div class="form-group">
          <label>Name</label>
          <input  type='text' value="${
            data.name
          }" name='name' class='form-control' required/>
          </div>
          <!--item--> 
          <div class="form-group">
          <label>Username</label>
          <input  type='text' value="${
            data.username
          }" name='username' class='form-control' required/>
          </div>
          <!--item-->  
          <div class="form-group">
          <label>Email</label>
          <input  type='email' value="${
            data.email ?? ""
          }" name='email' class='form-control'/>
          </div>
           
        <!--item-->
        <div class="form-group w-50">
        <label>Role</label>
        <select name="role_id" class="form-control" required>
        <option value="1" ${data.role == "1" ? "selected" : ""}>Admin</option>
        <option value="2" ${data.role == "2" ? "selected" : ""}>User</option>
        </select>
        </div>   

          <!--item-->
          <div class="form-group w-50">
          <button  type='submit' class="btn btn-primary" >Save</button>
          <button class="btn btn-secondary" type="button" id="back-btn" >Back</button>
          </div>
          <!--item-->
          
          </form>
          `;

        $("#app .card-body").html(update_item);
        changePageTitle("Update User");
        $("#back-btn").on("click", function () {
          getAll();
        });
      });
  });

  // 'update users form' submit handle will be here
  // will run if create user form was submitted
  $(document).on("submit", "#update_form", function (e) {
    e.preventDefault();
    const form = document.getElementById("update_form");
    const formData = {};
    // Get all input elements inside a form
    // and create key:value pairs inside formData
    form.querySelectorAll("input").forEach((element) => {
      formData[element.name] = element.value;
    });

    // Send data to backend
    fetch("http://localhost:81/task26/api/users/update/" + formData["id"], {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formData),
    }).then((res) => {
      if (res.ok) {
        //show all users
        getAll();
      } else {
        alert("Error. try again");
      }
    });
  });
  //end update

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
        fetch("http://localhost:81/task26/api/users/delete/" + id, {
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
