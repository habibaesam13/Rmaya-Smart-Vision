<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('fonts/fontawesome-free-7.0.1-web/css/all.min.css')}}" />
  <link rel="stylesheet" href="{{asset('css/publicGroupReg.css')}}" />
  <title>مسابقات الرمايه السنويه الرابع عشر - 2026</title>
  <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Amiri:ital,wght@0,400;0,700;1,400;1,700&family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Dancing+Script:wght@700&family=Lobster&family=Noto+Naskh+Arabic:wght@400..700&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Tajawal:wght@200;300;400;500;700;800;900&family=Zain:ital,wght@0,200;0,300;0,400;0,700;0,800;0,900;1,300;1,400&display=swap" rel="stylesheet">

  <link rel="icon" type="image/x-icon" href="{{asset('header_footer/logo1.ico')}}" />

</head>

<body>
  <header class="header-two">
    <div class="header-top">
      <div class="content">
        <div class="left-header-top">
          <div class="d-flex align-items-center gap-3">
            <img class="w-logo" src="{{asset('header_footer/logo1.png')}}" alt="logo" />
            <h1 class="title text-brown fw-bold">
              مسابقات الرماية السنوية - 2026
              من 1/11/2025 الى 1/2/2026
            </h1>
          </div>
        </div>
        <div class="right-header-top">
          <div class="working-time">
            <ul class="social">
              <li>
                <a href="https://www.snapchat.com/@rmaya.ae" class="social-item" target="_blank">
                  <i class="fab fa-snapchat"></i>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/rmaya.ae/" class="social-item" target="_blank">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
              <li>
                <a href="https://x.com/rmayafestival" class="social-item" target="_blank">
                  <i class="fab fa-x"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
  <section class="breadcrumb-area bg_image tmp-section-gap breadcrumb-bg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="breadcrumb-inner text-center">
            <h1 class="title split-collab" style="opacity: 1;">
              <h3 class="form-title fw-bold text-center"> تسجيل فرق اسقاط صحون </h3>
              <span class="circle"></span>
          </div>
        </div>
      </div>
    </div>
  </section>

  <main>

    <div class="container bg-form p-3 rounded-3">
      <div class="d-flex justify-content-between align-items-center">

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

        <div class="">
          <input type="text" name="team_name" placeholder="أسم الفريق" id="team_name"
            class="form-control w-100 @error('team_name') is-invalid @enderror"
            value="{{ old('team_name') }}" required style="border:1px #e7dac2 solid">
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
          <div class="text-warning d-flex justify-content-center align-items-center rounded-3">
            <p>الاسم يجب أن يكون باللغة العربية فقط</p>

            <p>الهاتف : 05XXXXXXX</p>

          </div>

          <div class="table-responsive">
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
        </div>
        <div class="col-12 d-flex justify-content-center align-items-center mt-3">
          <button type="submit" class="btn btn-brown w-20 fw-bold">تسجيل</button>
        </div>
      </form>
    </div>
  </main>
  <footer class="footer">
    <div class="container d-flex justify-content-between align-items-center">
      <div class="text-start">
        <a href="https://esmart-vision.com" target="_blank">
          <img src="https://rmaya.ae/sys26/public/header_footer/foter-logo-co.png" alt="">
        </a><span class="me-2">Powered By</span>
      </div>
      <div class="d-flex align-items-center text-end">
        © 2017 <span id="year"></span>
        جميع الحقوق محفوظة مسابقات الرماية
        <script>
          window.onload = function() {
            var yearSpan = document.getElementById("year");
            var currentYear = new Date().getFullYear();
            if (currentYear > 2017) {
              yearSpan.textContent = " - " + currentYear;
            }
          }
        </script>


      </div>
    </div>
  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
          const teamInput = document.getElementById('team_name');
          if (teamInput) {
            teamInput.addEventListener('input', e => {
              let value = e.target.value.normalize('NFC');
              value = value.replace(/[^\u0600-\u06FF\s]/g, '');
              e.target.value = value;
            });
          }
        });
    const oldMembers = @json(old('members', []));
    const oldTempFiles = @json(session('temp_files', []));

    document.querySelectorAll('.weapon-radio').forEach(radio => {
      radio.addEventListener('change', function() {
        const membersCount = this.dataset.members;
        const tbody = document.getElementById('membersTableBody');
        tbody.innerHTML = ''; // clear old rows

        for (let i = 0; i < membersCount; i++) {
          const member = oldMembers[i] || {};

          // Define temp file paths before using them
          const frontKey = `members[${i}][front_id_pic]`;
          const backKey = `members[${i}][back_id_pic]`;
          const tempFront = oldTempFiles[frontKey] ?
            `{{ asset('storage') }}/${oldTempFiles[frontKey].replace(/^public\//, '')}` :
            '';
          const tempBack = oldTempFiles[backKey] ?
            `{{ asset('storage') }}/${oldTempFiles[backKey].replace(/^public\//, '')}` :
            '';


          const row = `
        <tr>
          <td><input required class="form-control form-control-sm id-num" type="text"
            name="members[${i}][ID]" value="${member.ID || ''}" placeholder="00000000000000" minlength="15" maxlength="15"></td>

          <td><input required class="form-control form-control-sm id-date" type="date"
            name="members[${i}][Id_expire_date]" lang="en" value="${member.Id_expire_date || ''}"></td>

          <td><input required class="form-control form-control-sm name-input" type="text"
            name="members[${i}][name]" value="${member.name || ''}" placeholder="الاسم"></td>

          <td><input style="direction:ltr" required class="form-control form-control-sm phone-num"
            type="number" name="members[${i}][phone1]" value="${member.phone1 || ''}" placeholder="05xxxxxxxx"></td>

          <td><input required class="form-control form-control-sm birth-date" type="date"
            name="members[${i}][dob]" lang="en" value="${member.dob || ''}"></td>

          <td><input required class="form-control form-control-sm age" type="number"
            name="members[${i}][age]" value="${member.age || ''}" readonly placeholder="00"></td>

          <td>
          ${tempFront 
            ? `<img src="${tempFront}" alt="preview" style="width:37px;height:37px;object-fit:cover;border-radius:6px;">` 
            : ''
          }
          <input 
            ${tempFront ? '' : 'required'} 
            class="form-control form-control-sm id-front" 
            type="file"
            name="members[${i}][front_id_pic]" 
            accept=".jpg,.jpeg,.png">
          </td>

      <td>
        ${tempBack 
          ? `<img src="${tempBack}" alt="preview" style="width:37px;height:37px;object-fit:cover;border-radius:6px;">` 
          : ''
        }
        <input 
          ${tempBack ? '' : 'required'} 
          class="form-control form-control-sm id-back" 
          type="file"
          name="members[${i}][back_id_pic]" 
          accept=".jpg,.jpeg,.png">
      </td>

        </tr>`;
          tbody.insertAdjacentHTML('beforeend', row);
        }
        
        setupRowValidation();
      });
    });

    // ✅ Restore table automatically if user goes back after validation error
    document.addEventListener('DOMContentLoaded', function() {
      const selected = document.querySelector('.weapon-radio:checked');
      if (selected) {
        selected.dispatchEvent(new Event('change'));
      }
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
            fetch(`{{ url('/calculate-age') }}?dob=${dob}`)

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
          if (!value.startsWith('05')) value = '05' + value.replace(/^0+/, '');
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
  <script>
    document.addEventListener('change', async function(e) {
      if (e.target.matches('input[type=file]')) {
        const file = e.target.files[0];
        if (!file) return;
        const formData = new FormData();
        formData.append('file', file);
        formData.append('field', e.target.name);
        try {
          const response = await fetch(`{{ route('temp.upload') }}`, {
            method: 'POST',
            headers: {
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
          });
          const data = await response.json();
          if (data.success) {
            // Save path in hidden input
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = e.target.name + '_temp';
            hidden.value = data.path;
            e.target.closest('td').appendChild(hidden);
            console.log('Uploaded & stored in session:', data.path);
          }
        } catch (error) {
          console.error('Upload failed:', error);
        }
      }
    });
  </script>
</body>

</html>