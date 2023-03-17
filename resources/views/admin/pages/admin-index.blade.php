@extends('admin.layouts.apps')

@section('title','List Item - Test Project')

@section('meta')
    @include('admin.include.meta')
@endsection

@section('sidebar')
    @include('admin.include.sidebar')
@endsection

@section('header')
    @include('admin.include.header')
@endsection

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y">
    <button id="add_new_admin" type="button" class="btn btn-primary" style="margin-bottom:20px" data-bs-toggle="modal" data-bs-target="#modalCenter">
      <i class="bx bx-plus-medical mb-2"></i> Add New Admin
    </button>

    <div class="card">
      <h5 class="card-header">Admin List</h5>
      <div class="table-responsive text-nowrap">
        <table class="table text-center">
          <thead class="table-light">
            <tr>
              <th>Email</th>
              <th>Name</th>
            </tr>
          </thead>
          <tbody id="table_data" class="table-border-bottom-0">
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- Content wrapper -->

<!-- Modal -->
<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
    <form id="form_add_admin">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCenterTitle">Add New Admin</h5>
        <button
          type="button"
          class="btn-close"
          data-bs-dismiss="modal"
          aria-label="Close"
        ></button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col mb-3">
            <label for="emailWithTitle" class="form-label">Email</label>
            <input
              type="email"
              id="email_admin"
              class="form-control"
              placeholder="xxxx@xxx.xx"
              required
            />
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Name</label>
            <input
              type="text"
              id="name_admin"
              class="form-control"
              placeholder="Enter Name"
              required
            />
          </div>
        </div>
        <div class="row">
          <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Password</label>
            <input
              type="password"
              id="password_admin"
              class="form-control"
              placeholder="Enter Password"
              required
            />
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
          Close
        </button>
        <button id="btn_add_admin" type="submit" class="btn btn-primary">Save changes</button>
      </div>
</form>
    </div>
  </div>
</div>
@endsection

@section('custom-script')
  @include('admin.include.custom-script')
  <script>
    var resultsRef = firebase.database().ref('admins');
    resultsRef.on('child_added', (snapshot) => {
      const data = snapshot.val();
      $("#table_data").append(`
        <tr id="${snapshot.key}">
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>${data["email"] ?? ""}</strong></td>
          <td>${data["name"] ?? ""}</td>
        </tr>
      `)
    });

    resultsRef.on('child_changed', (snapshot) => {
      const data = snapshot.val();
      $("#"+snapshot.key).html(`
          <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>${data["email"] ?? ""}</strong></td>
          <td>${data["name"] ?? ""}</td>
      `)
    });

    resultsRef.on('child_removed', (snapshot) => {
      document.getElementById(snapshot.key).remove();
    });

    $("#form_add_admin").submit(function( event ) {
      event.preventDefault();
      $('#modalCenter').modal('hide');
      
      firebase.auth().createUserWithEmailAndPassword($("#email_admin").val(), $("#password_admin").val())
        .then((userCredential) => {
          firebase.database().ref("admins").push({
            "email":$("#email_admin").val(),
            "name":$("#name_admin").val()
          })

          Swal.fire(
            'Success',
            'Account Registered',
            'success'
          )
        })
        .catch((error) => {
          var errorMessage = error.message;
          Swal.fire(
            'Error',
            errorMessage,
            'error'
          )
        });
    });
  </script>
@endsection