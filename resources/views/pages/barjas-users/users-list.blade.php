@extends('layouts.app-barjas')
@section('title', 'List Pengguna')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet"
  href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.css') }}" />
@endsection
@section('content-barjas')
<!-- DataTable with Buttons -->
<div class="card">
  <div class="card-datatable table-responsive pt-0">
    <table class="datatables-basic table">
      <thead>
        <tr>
          <th>Id</th>
          <th>Nama Pengguna</th>
          <th>Email</th>
          <th>Tersimpan</th>
          <th>Terupdate</th>
          <th>Aksi</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!-- Modal tambah pengguna -->
<div class="offcanvas offcanvas-end" id="modal-tambah-pengguna">
  <div class="offcanvas-header border-bottom">
    <h5 class="offcanvas-title" id="exampleModalLabel">Tambah Pengguna</h5>
    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body flex-grow-1">
    <form class="add-new-record pt-0 row g-2" id="form-add-new-record" action="{{ route('buat-pengguna') }}"
      method="POST">
      @csrf
      <div class="col-sm-12">
        <label class="form-label">Nama Lengkap</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-user"></i></span>
          <input type="text" id="name" class="form-control dt-name" name="name" placeholder="Masukan Nama Lengkap" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label">Email</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-mail"></i></span>
          <input type="email" id="email" name="email" class="form-control dt-email"
            placeholder="Contoh : pengguna@rsudlembang.go.id" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label">Password</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-lock"></i></span>
          <input type="password" id="password" name="password" class="form-control dt-password"
            placeholder="********" />
        </div>
      </div>
      <div class="col-sm-12">
        <label class="form-label">Password</label>
        <div class="input-group input-group-merge">
          <span class="input-group-text"><i class="ti ti-lock"></i></span>
          <input type="password" id="password-confirm" name="password_confirmation"
            class="form-control dt-password-confirmation" placeholder="********" />
        </div>
      </div>
      <div class="col-sm-12">
        <button type="submit" class="btn btn-primary data-submit me-sm-3 me-1">Simpan</button>
        <button type="reset" class="btn btn-outl ine-secondary" data-bs-dismiss="offcanvas">Batal</button>
      </div>
    </form>
  </div>
</div>
<!--/ DataTable with Buttons -->
@push('script')
<script src="{{ asset('assets/vendor/libs/sweetalert2/sweetalert2.js') }}"></script>
<script>
  let fv, offCanvasEl;
  document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const formAddNewRecord = document.getElementById('form-add-new-record');

    setTimeout(() => {
      const newRecord = document.querySelector('.tambah-pengguna'),
      offCanvasElement = document.querySelector('#modal-tambah-pengguna');

      // To open offCanvas, to add new record
      if (newRecord) {
        newRecord.addEventListener('click', function () {
          offCanvasEl = new bootstrap.Offcanvas(offCanvasElement);
          // Empty fields on offCanvas open
            (offCanvasElement.querySelector('.dt-name').value = ''),
            (offCanvasElement.querySelector('.dt-email').value = ''),
            (offCanvasElement.querySelector('.dt-password').value = ''),
            (offCanvasElement.querySelector('.dt-password-confirmation').value = ''),
          // Open offCanvas with form
          offCanvasEl.show();
        });
      }
    }, 200);

    // Form validation for Add new record
    fv = FormValidation.formValidation(formAddNewRecord, {
      fields: {
        name: {
          validators: {
            notEmpty: {
              message: 'Nama lengkap harus di isi'
            }
          }
        },
        email: {
          validators: {
            notEmpty: {
              message: 'The Email is required'
            },
            emailAddress: {
              message: 'The value is not a valid email address'
            }
          }
        },
        password: {
          validators: {
            notEmpty: {
              message: 'Password harus di isi'
            }
          }
        },
        password_confirmation: {
          validators: {
            notEmpty: {
              message: 'Konfirmasi password harus di isi'
            }
          }
        }
      },
      plugins: {
        trigger: new FormValidation.plugins.Trigger(),
        bootstrap5: new FormValidation.plugins.Bootstrap5({
          eleValidClass: '',
          rowSelector: '.col-sm-12'
        }),
        submitButton: new FormValidation.plugins.SubmitButton(),
        autoFocus: new FormValidation.plugins.AutoFocus()
      },
      init: instance => {
        instance.on('plugins.message.placed', function (e) {
          if (e.element.parentElement.classList.contains('input-group')) {
            e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
          }
        });
      }
    });
  })();
});

// datatable (jquery)
$(function () {
  var dt_basic_table = $('.datatables-basic'),
  dt_basic;
  // DataTable with buttons
  // --------------------------------------------------------------------
  if (dt_basic_table.length) {
    dt_basic = dt_basic_table.DataTable({
      ajax: '/api-list-pengguna',
      dataSrc: 'data',
      columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
        { data: 'created_at' },
        { data: 'updated_at' },
        { data: '' }
      ],
      columnDefs: [
        {
          // For Responsive
          className: 'control',
          orderable: false,
          searchable: false,
          render: function (data, type, full, meta) {
            return '';
          }
        },
        {
          targets: 0,
          visible: false,
          searchable: false,
        },
        {
          // Actions
          targets: -1,
          title: 'Actions',
          orderable: false,
          searchable: false,
          render: function (data, type, row) {
            return (
              '<meta name="csrf-token" content="{{ csrf_token() }}">' +
              '<a onclick="hapus_pengguna('+row.id+')" class="btn btn-sm btn-icon item-delete"><i class="text-danger ti ti-trash"></i></a>' +
              '<a href="javascript:;" class="btn btn-sm btn-icon item-edit"><i class="text-warning ti ti-pencil"></i></a>'
            );
          }
        }
      ],
      dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-3 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
      displayLength: 10,
      lengthMenu: [10, 25, 50, 75, 100],
      buttons: [
        {
          extend: 'collection',
          className: 'btn btn-label-primary dropdown-toggle me-2',
          text: '<i class="ti ti-file-export me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
          buttons: [
            {
              extend: 'print',
              text: '<i class="ti ti-printer me-1" ></i>Print',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              },
              customize: function (win) {
                //customize print view for dark
                $(win.document.body)
                  .css('color', config.colors.headingColor)
                  .css('border-color', config.colors.borderColor)
                  .css('background-color', config.colors.bodyBg);
                $(win.document.body)
                  .find('table')
                  .addClass('compact')
                  .css('color', 'inherit')
                  .css('border-color', 'inherit')
                  .css('background-color', 'inherit');
              }
            },
            {
              extend: 'csv',
              text: '<i class="ti ti-file-text me-1" ></i>Csv',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'excel',
              text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'pdf',
              text: '<i class="ti ti-file-description me-1"></i>Pdf',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            },
            {
              extend: 'copy',
              text: '<i class="ti ti-copy me-1" ></i>Copy',
              className: 'dropdown-item',
              exportOptions: {
                columns: [2, 3, 4, 5],
                // prevent avatar to be display
                format: {
                  body: function (inner, coldex, rowdex) {
                    if (inner.length <= 0) return inner;
                    var el = $.parseHTML(inner);
                    var result = '';
                    $.each(el, function (index, item) {
                      if (item.classList !== undefined && item.classList.contains('user-name')) {
                        result = result + item.lastChild.firstChild.textContent;
                      } else if (item.innerText === undefined) {
                        result = result + item.textContent;
                      } else result = result + item.innerText;
                    });
                    return result;
                  }
                }
              }
            }
          ]
        },
        {
          text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Pengguna</span>',
          className: 'tambah-pengguna btn btn-primary'
        }
      ],
    });
    $('div.head-label').html('<h5 class="card-title mb-0">Pengguna</h5>');
  }

  $('.datatables-basic tbody').on('click', '.delete-record', function () {
    dt_basic.row($(this).parents('tr')).remove().draw();
    var token = $("meta[name='csrf-token']").attr("content");
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      customClass: {
        confirmButton: 'btn btn-primary me-3',
        cancelButton: 'btn btn-label-secondary'
      },
      buttonsStyling: false
    }).then(function () {
      $.ajax({
        type: "DELETE",
        url: id+"/hapus-pengguna",
        data: { "id": id, "_token": token, },
        cache: false,
        success: function(response) {
          Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: response.success,
            customClass: {
              confirmButton: 'btn btn-success'
            }
          }).then(function(){
            location.reload()
          });
        },
        failure: function (response) {
          Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Gagal menghapus data pengguna',
            customClass: {
              confirmButton: 'btn btn-danger'
            }
          });
        }
      });
    });
  });
});

function hapus_pengguna(id){
  var token = $("meta[name='csrf-token']").attr("content");
  Swal.fire({
    title: 'Apakah anda yakin?',
    text: "Data pengguna tidak dapat di kembalikan setelah di hapus!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Ya, Hapus!',
    customClass: {
      confirmButton: 'btn btn-primary me-3',
      cancelButton: 'btn btn-label-secondary'
    },
    buttonsStyling: false
  }).then(function () {
    $.ajax({
      type: "DELETE",
      url: id+"/hapus-pengguna",
      data: { "id": id, "_token": token, },
      cache: false,
      success: function(response) {
        Swal.fire({
          icon: 'success',
          title: 'Sukses',
          text: response.success,
          customClass: {
            confirmButton: 'btn btn-success'
          }
        }).then(function(){
          dt_basic.row($(this).parents('tr')).remove().draw();
        });
      },
      failure: function (response) {
        Swal.fire({
          icon: 'error',
          title: 'Gagal',
          text: 'Gagal menghapus data pengguna',
          customClass: {
            confirmButton: 'btn btn-danger'
          }
        });
      }
    });
  });
}
</script>
@endpush
@endsection