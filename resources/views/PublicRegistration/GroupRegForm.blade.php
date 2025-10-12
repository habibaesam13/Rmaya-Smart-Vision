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
    {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
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

    
      <form action="{{route('store-public-group-registration')}}" method="POST" enctype="multipart/form-data" class="p-2">
        @csrf

        <div class="my-2 w-75 mx-auto">
          <input type="text" name="name" placeholder="أسم الفريق" class="form-control w-100" required>
        </div>

        <div class="row mt-3">
          @foreach($weapons as $weapon)
          <div class="col-md-6 col-lg-4 col-xl-3">
            <div>
              <input class="form-check-input weapon-radio"
                     type="radio"
                     name="weapon_id"
                     id="weapon_{{$weapon->wid}}"
                     value="{{$weapon->wid}}"
                     data-members="{{$weapon->number_of_members}}">
              <label class="form-check-label" for="weapon_{{$weapon->wid}}">
                {{$weapon->name}}
                
              </label>
            </div>
          </div>
          @endforeach
        </div>

        <div class="tabel-container ">
          <table >
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

  <script>
    document.querySelectorAll('.weapon-radio').forEach(radio => {
      radio.addEventListener('change', function() {
        const membersCount = this.dataset.members;
        const tbody = document.getElementById('membersTableBody');
        tbody.innerHTML = ''; // clear old rows

        for (let i = 0; i < membersCount; i++) {
          const row = `
            <tr>
              <td class="px-1"><input required class="form-control form-control-sm" type="number" placeholder="0000 000000 0000" name="members[${i}][id_number]"></td>
              <td class="px-1"><input required class="form-control form-control-sm" type="date" name="members[${i}][id_expiry]"></td>
              <td class="px-1"><input required class="form-control form-control-sm" type="text" placeholder="الاسم" name="members[${i}][name]"></td>
              <td class="px-1"><input required class="form-control form-control-sm" type="number" placeholder="055 0000000" name="members[${i}][phone]"></td>
              <td class="px-1"><input required class="form-control form-control-sm" type="date" name="members[${i}][dob]"></td>
              <td class="px-1"><input required class="form-control form-control-sm" type="number" name="members[${i}][age]" placeholder="00"></td>
              <td class="px-1"><input required class="form-control form-control-sm" type="file" name="members[${i}][id_front]" accept="image/*"></td>
              <td class="px-1"><input required class="form-control form-control-sm" type="file" name="members[${i}][id_back]" accept="image/*"></td>
            </tr>`;
          tbody.insertAdjacentHTML('beforeend', row);
        }
      });
    });
  </script>

</body>
</html>
