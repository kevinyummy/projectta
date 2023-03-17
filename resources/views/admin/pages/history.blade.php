@extends('admin.layouts.apps')

@section('title','History List - Test Project')

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
    <div class="card">
      <h5 class="card-header">History List</h5>
      <div class="table-responsive text-nowrap">
        <table class="table text-center">
          <thead class="table-light">
            <tr>
              <th>Created By</th>
              <th>Type</th>
              <th>Original File</th>
              <th>File</th>
              <th>Created At</th>
              <th>Bukti Pembayaran</th>
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
@endsection

@section('custom-script')
    @include('admin.include.custom-script')
    <script>
      var resultsRef = firebase.database().ref('results');
      resultsRef.on('child_added', (snapshot) => {
        const data = snapshot.val();
        $("#table_data").append(`
          <tr id="${snapshot.key}">
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>${data["created_by"] ?? ""}</strong></td>
            <td>${data["type"] ?? ""}</td>
            <td><a href="${data["original_file"]}" target="_blank"><span class="badge bg-label-primary me-1"><i class="bx bx-download"></i></span></a></td>
            <td><a href="${data["data"]}" target="_blank"><span class="badge bg-label-primary me-1"><i class="bx bx-download"></i></span></a></td>
            <td>${data["created_at"] ?? ""}</td>
            <td><a href="${data["bukti_pembayaran"]}" target="_blank"><span class="badge bg-label-primary me-1"><i class="bx bx-download"></i></span></a></td>
          </tr>
        `)
      });

      resultsRef.on('child_changed', (snapshot) => {
        const data = snapshot.val();
        $("#"+snapshot.key).html(`
            <td><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>${data["created_by"] ?? ""}</strong></td>
            <td>${data["type"] ?? ""}</td>
            <td><a href="${data["original_file"]}" target="_blank"><span class="badge bg-label-primary me-1"><i class="bx bx-download"></i></span></a></td>
            <td><a href="${data["data"]}" target="_blank"><span class="badge bg-label-primary me-1"><i class="bx bx-download"></i></span></a></td>
            <td>${data["created_at"] ?? ""}</td>
            <td><a href="${data["bukti_pembayaran"]}" target="_blank"><span class="badge bg-label-primary me-1"><i class="bx bx-download"></i></span></a></td>
        `)
      });

      resultsRef.on('child_removed', (snapshot) => {
        document.getElementById(snapshot.key).remove();
      });
    </script>
@endsection