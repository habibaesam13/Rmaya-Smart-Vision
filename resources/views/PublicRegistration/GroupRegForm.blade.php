<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('fonts/fontawesome-free-7.0.1-web/css/all.min.css')}}" />
  <link rel="stylesheet" href="{{asset('css/publicGroupReg.css')}}" />
  <title>مسابقات الرمايه السنوية</title>
</head>

<body>
  <nav class="d-flex justify-content-between align-items-center bg-baige px-5 py-2">

    <div class="d-flex align-items-center gap-3">
      <img class="w-logo" src="{{asset('header_footer/logo1.png')}}" alt="logo" />
      <h1 class="title text-brown fw-bold">ميادين الريف للرماية 2025
        <br>
        <span class="date-size">من 03/ 12 / 2024 الى 14/ 02 / 2025</span>
      </h1>
    </div>
    <i class="fa-solid fa-globe fa-xl color-icon"></i>
  </nav>

  <main>
    
    <div class="container bg-form p-3 rounded-3">
      <div class="d-flex justify-content-between align-items-center">
        <h3 class="form-title text-brown fw-bold text-center background-skewed">
          تسجيل فرق اسقاط صحون             
        </h3>
      </div>
      @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show " role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

      <form action="{{route('store-public-group-registration')}}" method="POST" enctype="multipart/form-data" class="p-2">
        @csrf

        <div class="my-2 w-75 mx-auto">
          <input type="text" name="team_name" placeholder="أسم الفريق"
            class="form-control w-100 @error('team_name') is-invalid @enderror"
            value="{{ old('team_name') }}" required>
          @error('team_name')
          <div class="invalid-feedback d-block">{{ $message }}</div>
          @enderror
        </div>

        <div class="row mt-3">
          @foreach($weapons as $weapon)
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input weapon-radio @error('weapon_id') is-invalid @enderror"
                type="radio"
                name="weapon_id"
                id="weapon_{{$weapon->wid}}"
                value="{{$weapon->wid}}"
                {{ old('weapon_id') == $weapon->wid ? 'checked' : '' }}
                data-members="{{$weapon->number_of_members}}">
              <label class="form-check-label" for="weapon_{{$weapon->wid}}">
                {{$weapon->name}}
              </label>
            </div>
          </div>
          @endforeach
          @error('weapon_id')
          <div class="invalid-feedback d-block text-danger">{{ $message }}</div>
          @enderror
        </div>


        <div class="tabel-container ">
          <div class="text-warning d-flex m-2 gap-4">
            <p>الاسم يجب أن يكون باللغة العربية فقط</p>
            <p>الهاتف : 055XXXXXXX</p>
          </div>
          <table>
            <thead>
              <tr>
                <th style="min-width: 160px;">رقم الهوية</th>
                <th style="min-width: 160px;">تاريخ نهاية الهوية</th>
                <th style="min-width: 160px;">الاسم كاملا</th>
                <th style="min-width: 160px;">الهاتف</th>
                <th style="min-width: 160px;">تاريخ الميلاد</th>
                <th style="min-width: 80px;">العمر</th>
                <th style="min-width: 160px;">صورة الهوية امامى</th>
                <th style="min-width: 160px;">صورة الهوية خلفى</th>
              </tr>
            </thead>
            <tbody id="membersTableBody">
              <!-- Rows will be generated here dynamically -->
            </tbody>
          </table>
        </div>

        <div class="col-12 d-flex justify-content-center align-items-center mt-3">
          <button type="submit" class="btn btn-brown w-50 fw-bold">تسجيل</button>
        </div>
      </form>
    </div>
  </main>

  <footer class="bg-baige footer py-3">
    <div class="d-flex justify-content-around align-items-center px-5">
      <div class="text-brown fw-800">
        copy&copy;rmaya.ae 2025
      </div>
      <div>
        <img src="{{asset('header_footer/foter-logo-co.png')}}" alt="">
      </div>
    </div>
  </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.querySelectorAll('.weapon-radio').forEach(radio => {
      radio.addEventListener('change', function() {
        const membersCount = this.dataset.members;
        const tbody = document.getElementById('membersTableBody');
        tbody.innerHTML = ''; // clear old rows

        for (let i = 0; i < membersCount; i++) {
          const row = `
        <tr>
          <td><input required class="form-control form-control-sm id-num" type="text" name="members[${i}][ID]" placeholder="0000 000000 0000"></td>
          <td><input required class="form-control form-control-sm id-date" type="date" name="members[${i}][Id_expire_date]"></td>
          <td><input required class="form-control form-control-sm name-input" type="text" name="members[${i}][name]" placeholder="الاسم"></td>
          <td><input required class="form-control form-control-sm phone-num" type="number" name="members[${i}][phone1]" placeholder="055 0000000"></td>
          <td><input required class="form-control form-control-sm birth-date" type="date" name="members[${i}][dob]"></td>
          <td><input required class="form-control form-control-sm age" type="number" name="members[${i}][age]" readonly placeholder="00"></td>
          <td><input required class="form-control form-control-sm id-front" type="file" name="members[${i}][front_id_pic]" accept=".jpg,.jpeg,.png"></td>
          <td><input required class="form-control form-control-sm id-back" type="file" name="members[${i}][back_id_pic]" accept=".jpg,.jpeg,.png"></td>
        </tr>`;
          tbody.insertAdjacentHTML('beforeend', row);
        }

        // Attach validation logic for all new rows
        setupRowValidation();
      });
    });


    function setupRowValidation() {
      const today = new Date();
      const year = today.getFullYear();
      const month = String(today.getMonth() + 1).padStart(2, '0');
      const day = String(today.getDate() + 1).padStart(2, '0');
      const minIdExpiry = `${year}-${month}-${day}`;

      const maxDob = minIdExpiry;

      // --- ID Expiry must be in the future ---
      document.querySelectorAll('.id-date').forEach(input => {
        input.setAttribute('min', minIdExpiry);
      });

      // --- DOB max today ---
      document.querySelectorAll('.birth-date').forEach(input => {
        input.setAttribute('max', maxDob);

        // AJAX: calculate age
        input.addEventListener('change', function() {
          const dob = this.value;
          const ageField = this.closest('tr').querySelector('.age');
          if (dob) {
            fetch(`{{ route('calculate.age') }}?dob=${dob}`)
              .then(response => response.json())
              .then(data => {
                ageField.value = data.age ?? '';
              })
              .catch(() => ageField.value = '');
          } else {
            ageField.value = '';
          }
        });
      });

      // --- National ID (15 digits numeric only) ---
      document.querySelectorAll('.id-num').forEach(input => {
        input.addEventListener('input', e => {
          let value = e.target.value.replace(/\D/g, '');
          if (value.length > 15) value = value.slice(0, 15);
          e.target.value = value;
        });
      });

      // --- Name: Arabic letters + spaces only ---
      document.querySelectorAll('.name-input').forEach(input => {
        input.addEventListener('input', e => {
          let value = e.target.value.normalize('NFC');
          value = value.replace(/[^\u0600-\u06FF\s]/g, '');
          e.target.value = value;
        });
      });

      // --- Phone validation (must start with 055 and be 10 digits) ---
      document.querySelectorAll('.phone-num').forEach(input => {
        input.addEventListener('input', e => {
          let value = e.target.value.replace(/\D/g, '');
          if (!value.startsWith('055')) value = '055' + value.replace(/^0+/, '');
          if (value.length > 10) value = value.slice(0, 10);
          e.target.value = value;
        });
        input.addEventListener('paste', e => e.preventDefault());
      });

      // --- File validation (only images .jpg/.jpeg/.png, max size 2MB) ---
      document.querySelectorAll('.id-front, .id-back').forEach(input => {
        input.addEventListener('change', e => {
          const file = e.target.files[0];
          if (file) {
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
              alert('يجب أن تكون صورة الهوية بصيغة JPG أو PNG فقط');
              e.target.value = '';
              return;
            }
            if (file.size > 2 * 1024 * 1024) {
              alert('حجم الملف لا يجب أن يزيد عن 2 ميجابايت');
              e.target.value = '';
            }
          }
        });
      });
    }
  </script>


</body>

</html>